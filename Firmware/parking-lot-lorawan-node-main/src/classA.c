/*!
 * \file      main.c
 *
 * \brief     LoRaMac classA device implementation
 *
 * \copyright Revised BSD License, see section \ref LICENSE.
 *
 * \code
 *                ______                              _
 *               / _____)             _              | |
 *              ( (____  _____ ____ _| |_ _____  ____| |__
 *               \____ \| ___ |    (_   _) ___ |/ ___)  _ \
 *               _____) ) ____| | | || |_| ____( (___| | | |
 *              (______/|_____)_|_|_| \__)_____)\____)_| |_|
 *              (C)2013-2017 Semtech
 *
 * \endcode
 *
 * \author    Miguel Luis ( Semtech )
 *
 * \author    Gregory Cristian ( Semtech )
 */

#include <stdio.h>
#include "utilities.h"
#include "LoRaMac.h"
#include "Commissioning.h"
#include "tremo_gpio.h" 

extern uint8_t interrupt_flag;
extern gpio_t *GPIO_USING ;
extern uint8_t ir_pin ;
extern uint8_t Signal_LED;
extern uint8_t ir_pin_slot4;
uint8_t count=0;
uint32_t count_waiting_for_response=0;
uint16_t count_toggle=0;
uint8_t send_flag=0;

//bool mlme_confirm=false;

uint8_t mlme_received= 0;
gpio_level_t last_ir_state;
gpio_level_t last_ir_state_slot4;
bool connection_state =false;
bool gateway_response_yet=true;



#ifndef ACTIVE_REGION

#warning "No active region defined, LORAMAC_REGION_CN470 will be used as default."

#define ACTIVE_REGION LORAMAC_REGION_AS923

#endif

/*!
 * Defines the application data transmission duty cycle. 5s, value in [ms].
 */
#define APP_TX_DUTYCYCLE                            2000

/*!
 * Defines a random delay for application data transmission duty cycle. 1s,
 * value in [ms].
 */
#define APP_TX_DUTYCYCLE_RND                        1000

/*!
 * Default datarate
 */
#define LORAWAN_DEFAULT_DATARATE                    DR_0

/*!
 * LoRaWAN confirmed messages
 */
#define LORAWAN_CONFIRMED_MSG_ON                    true
#define LORAWAN_CONFIRMED_MSG_OFF                   false
/*!
 * LoRaWAN Adaptive Data Rate
 *
 * \remark Please note that when ADR is enabled the end-device should be static
 */
#define LORAWAN_ADR_ON                              1

/*!
 * LoRaWAN application port
 */
#define LORAWAN_APP_PORT                            2
   
static uint8_t DevEui[] = LORAWAN_DEVICE_EUI;
static uint8_t AppEui[] = LORAWAN_APPLICATION_EUI;
static uint8_t AppKey[] = LORAWAN_APPLICATION_KEY;


#if( OVER_THE_AIR_ACTIVATION == 0 )

static uint8_t NwkSKey[] = LORAWAN_NWKSKEY;
static uint8_t AppSKey[] = LORAWAN_APPSKEY;
static uint32_t DevAddr = LORAWAN_DEVICE_ADDRESS;

#endif

/*!
 * Application port
 */
static uint8_t AppPort = LORAWAN_APP_PORT;

/*!
 * User application data size
 */
static uint8_t AppDataSize = 4;
/*!
 * User application data buffer size
 */
#define LORAWAN_APP_DATA_MAX_SIZE                           16

/*!
 * User application data
 */
static uint8_t AppData[LORAWAN_APP_DATA_MAX_SIZE];

/*!
 * Indicates if the node is sending confirmed or unconfirmed messages
 */
static uint8_t IsTxConfirmed = LORAWAN_CONFIRMED_MSG_ON;

/*!
 * Defines the application data transmission duty cycle
 */
static uint32_t TxDutyCycleTime = APP_TX_DUTYCYCLE;

/*!
 * Timer to handle the application data transmission duty cycle
 */
static TimerEvent_t TxNextPacketTimer;

/*!
 * Indicates if a new packet can be sent
 */
static bool NextTx = true;

/*!
 * Device states
 */
static enum eDeviceState
{
    DEVICE_STATE_INIT,
    DEVICE_STATE_JOIN,
    DEVICE_STATE_SEND,
    DEVICE_STATE_RESEND,
    DEVICE_STATE_CYCLE,
    DEVICE_STATE_SLEEP
}DeviceState;

/*!
 * \brief   Prepares the payload of the frame
 */
static void PrepareTxFrame( uint8_t port ,gpio_level_t something,gpio_level_t something2)
{
    AppDataSize = 12;
    AppData[0] = 'S';
    AppData[1] = 'L';
    AppData[2] = 'O';
    AppData[3] = 'T';
    AppData[4] = '1';
    AppData[5] = (something==1)?'1':'0';
     AppData[6] = 'S';
    AppData[7] = 'L';
    AppData[8] = 'O';
    AppData[9] = 'T';
    AppData[10] = '4';
    AppData[11] = (something2==1)?'1':'0';
    printf(" preparetxframe %d",something);
}

/*!
 * \brief   Prepares the payload of the frame
 *
 * \retval  [0: frame could be send, 1: error]
 */
static bool SendFrame( void )
{
    McpsReq_t mcpsReq;
    LoRaMacTxInfo_t txInfo;
       connection_state = false;
    if( LoRaMacQueryTxPossible( AppDataSize, &txInfo ) != LORAMAC_STATUS_OK )
    {
        // Send empty frame in order to flush MAC commands
        mcpsReq.Type = MCPS_UNCONFIRMED;
        mcpsReq.Req.Unconfirmed.fBuffer = NULL;
        mcpsReq.Req.Unconfirmed.fBufferSize = 0;
        mcpsReq.Req.Unconfirmed.Datarate = LORAWAN_DEFAULT_DATARATE;
         printf(" does send uplink empty string ");
    }
    else
    {
        if( IsTxConfirmed == false )
        {
            mcpsReq.Type = MCPS_UNCONFIRMED;
            mcpsReq.Req.Unconfirmed.fPort = AppPort;
            mcpsReq.Req.Unconfirmed.fBuffer = AppData;
            mcpsReq.Req.Unconfirmed.fBufferSize = AppDataSize;
            mcpsReq.Req.Unconfirmed.Datarate = LORAWAN_DEFAULT_DATARATE;
            printf(" does send uplink  string   MCPS_UNCONFIRMED");
        }
        else
        {
            mcpsReq.Type = MCPS_CONFIRMED;
            mcpsReq.Req.Confirmed.fPort = AppPort;
            mcpsReq.Req.Confirmed.fBuffer = AppData;
            mcpsReq.Req.Confirmed.fBufferSize = AppDataSize;
            mcpsReq.Req.Confirmed.NbTrials = 8;
            mcpsReq.Req.Confirmed.Datarate = LORAWAN_DEFAULT_DATARATE;
            printf(" does send uplink  string   MCPS_CONFIRMED");
        }
    }

    if( LoRaMacMcpsRequest( &mcpsReq ) == LORAMAC_STATUS_OK )
    {
        return false;
    }
    
    
    return true;
}

/*!
 * \brief Function executed on TxNextPacket Timeout event
 */
static void OnTxNextPacketTimerEvent( void )
{
    MibRequestConfirm_t mibReq;
    LoRaMacStatus_t status;

    TimerStop( &TxNextPacketTimer );

    mibReq.Type = MIB_NETWORK_JOINED;
    status = LoRaMacMibGetRequestConfirm( &mibReq );
    printf( " OnTxNextPacketTimerEvent \n");
    printf(" interrup flag = %d",interrupt_flag);
    if( status == LORAMAC_STATUS_OK )
    {
        if( mibReq.Param.IsNetworkJoined == true )
        {   printf("already joined the network \n");
            DeviceState = DEVICE_STATE_SEND;
            NextTx = true;

        }
        else
        {   
                mlme_received=0;
            printf(" network not joined yet \n");
            // Network not joined yet. Try to join again
            MlmeReq_t mlmeReq;
            mlmeReq.Type = MLME_JOIN;
            mlmeReq.Req.Join.DevEui = DevEui;
            mlmeReq.Req.Join.AppEui = AppEui;
            mlmeReq.Req.Join.AppKey = AppKey;
      //  gpio_toggle(GPIO_USING,Signal_LED);
            if( LoRaMacMlmeRequest( &mlmeReq ) == LORAMAC_STATUS_OK )
            {
                DeviceState = DEVICE_STATE_SLEEP;
            }
            else
            {
                DeviceState = DEVICE_STATE_CYCLE;
            }
        }
    }
}

/*!
 * \brief   MCPS-Confirm event function
 *
 * \param   [IN] mcpsConfirm - Pointer to the confirm structure,
 *               containing confirm attributes.
 */
static void McpsConfirm( McpsConfirm_t *mcpsConfirm )
{
    if( mcpsConfirm->Status == LORAMAC_EVENT_INFO_STATUS_OK )
    {
        switch( mcpsConfirm->McpsRequest )
        {
            case MCPS_UNCONFIRMED:
            {
                // Check Datarate
                // Check TxPower
                break;
            }
            case MCPS_CONFIRMED:
            {
                // Check Datarate
                // Check TxPower
                // Check AckReceived
                // Check NbTrials
                break;
            }
            case MCPS_PROPRIETARY:
            {
                break;
            }
            default:
                break;
        }
    }
    NextTx = true;
}

/*!
 * \brief   MCPS-Indication event function
 *
 * \param   [IN] mcpsIndication - Pointer to the indication structure,
 *               containing indication attributes.
 */
static void McpsIndication( McpsIndication_t *mcpsIndication )
{
    if( mcpsIndication->Status != LORAMAC_EVENT_INFO_STATUS_OK )
    {
        return;
   }
   count++;
    printf (" last ir state %d \n" , last_ir_state);
 if (last_ir_state!= gpio_read(GPIO_USING,ir_pin))
    {
        count=1;
        printf(" count =1 \n");
    }

   if(count==2)
    {interrupt_flag=0;
    count=0;}


   gateway_response_yet=true;
    
gpio_write(GPIO_USING,Signal_LED,GPIO_LEVEL_HIGH);
        connection_state=true;
    printf( "receive data: rssi = %d, snr = %d, datarate = %d ,datareceive : %s \r\n", mcpsIndication->Rssi, (int)mcpsIndication->Snr,
                 (int)mcpsIndication->RxDatarate,mcpsIndication->Buffer);
    switch( mcpsIndication->McpsIndication )
    {
        case MCPS_UNCONFIRMED:
        {
            break;
        }
        case MCPS_CONFIRMED:
        {
            break;
        }
        case MCPS_PROPRIETARY:
        {
            break;
        }
        case MCPS_MULTICAST:
        {
            break;
        }
        default:
            break;
    }

             switch (mcpsIndication->Status )
{
    case LORAMAC_EVENT_INFO_STATUS_RX1_TIMEOUT :
    printf(" RX1 TIMEOUT");
    break;

    case LORAMAC_EVENT_INFO_STATUS_RX2_TIMEOUT :
    printf(" RX2 TIMEOUT");

    default:
    break;



}
    // Check Multicast
    // Check Port
    // Check Datarate
    // Check FramePending
    if( mcpsIndication->FramePending == true )
    {
        // The server signals that it has pending data to be sent.
        // We schedule an uplink as soon as possible to flush the server.
        OnTxNextPacketTimerEvent( );
    }


 
    // Check Buffer
    // Check BufferSize
    // Check Rssi
    // Check Snr
    // Check RxSlot
    if( mcpsIndication->RxData == true )
    {
    }
}

/*!
 * \brief   MLME-Confirm event function
 *
 * \param   [IN] mlmeConfirm - Pointer to the confirm structure,
 *               containing confirm attributes.
 */
static void MlmeConfirm( MlmeConfirm_t *mlmeConfirm )
{
    switch( mlmeConfirm->MlmeRequest )
    {
        case MLME_JOIN:
        {
            if( mlmeConfirm->Status == LORAMAC_EVENT_INFO_STATUS_OK )
            {   mlme_received=1;
               // mlme_confirm=true;
                printf("joined\r\n");
                // Status is OK, node has joined the network
                DeviceState = DEVICE_STATE_SEND;
                interrupt_flag=1;
               // PrepareTxFrame( AppPort ,gpio_read(GPIO_USING,ir_pin),gpio_read(GPIO_USING,ir_pin_slot4));
               // bool something = SendFrame( );
            }
            else
            {
                MlmeReq_t mlmeReq;
              //  gpio_toggle(GPIO_USING,Signal_LED);
                printf("join failed\r\n");
                // Join was not successful. Try to join again
                mlmeReq.Type = MLME_JOIN;
                mlmeReq.Req.Join.DevEui = DevEui;
                mlmeReq.Req.Join.AppEui = AppEui;
                mlmeReq.Req.Join.AppKey = AppKey;
                mlmeReq.Req.Join.NbTrials = 8;

                if( LoRaMacMlmeRequest( &mlmeReq ) == LORAMAC_STATUS_OK )
                {
                    DeviceState = DEVICE_STATE_SLEEP;
                }
                else
                {
                    DeviceState = DEVICE_STATE_CYCLE;
                }
            }
            break;
        }
        case MLME_LINK_CHECK:
        {
            if( mlmeConfirm->Status == LORAMAC_EVENT_INFO_STATUS_OK )
            {
                // Check DemodMargin
                // Check NbGateways
            }
            break;
        }
        default:
            break;
    }
    NextTx = true;
}

/*!
 * \brief   MLME-Indication event function
 *
 * \param   [IN] mlmeIndication - Pointer to the indication structure.
 */
static void MlmeIndication( MlmeIndication_t *mlmeIndication )
{
    //gpio_toggle(GPIO_USING,Signal_LED);
    switch( mlmeIndication->MlmeIndication )
    {
        case MLME_SCHEDULE_UPLINK:
        {// The MAC signals that we shall provide an uplink as soon as possible
            OnTxNextPacketTimerEvent( );
            break;
        }
        default:
            break;
    }
}

static void lwan_dev_params_update( void )
{
    MibRequestConfirm_t mibReq;
    uint16_t channelsMaskTemp[6];
    channelsMaskTemp[0] = 0x00FF;
    channelsMaskTemp[1] = 0x0000;
    channelsMaskTemp[2] = 0x0000;
    channelsMaskTemp[3] = 0x0000;
    channelsMaskTemp[4] = 0x0000;
    channelsMaskTemp[5] = 0x0000;

    mibReq.Type = MIB_CHANNELS_DEFAULT_MASK;
    mibReq.Param.ChannelsDefaultMask = channelsMaskTemp;
    LoRaMacMibSetRequestConfirm(&mibReq);
    mibReq.Type = MIB_CHANNELS_MASK;
    mibReq.Param.ChannelsMask = channelsMaskTemp;
    LoRaMacMibSetRequestConfirm(&mibReq);
}

uint8_t BoardGetBatteryLevel( void )
{
    return 0;
}


/**
 * Main application entry point.
 */
int app_start( void )
{
    LoRaMacPrimitives_t LoRaMacPrimitives;
    LoRaMacCallback_t LoRaMacCallbacks;
    MibRequestConfirm_t mibReq;


    DeviceState = DEVICE_STATE_INIT;

    printf("ClassA app start\r\n");
    while( 1 )
    {
        switch( DeviceState )
        {
            case DEVICE_STATE_INIT:
            {
                LoRaMacPrimitives.MacMcpsConfirm = McpsConfirm;
                LoRaMacPrimitives.MacMcpsIndication = McpsIndication;
                LoRaMacPrimitives.MacMlmeConfirm = MlmeConfirm;
                LoRaMacPrimitives.MacMlmeIndication = MlmeIndication;
                LoRaMacCallbacks.GetBatteryLevel = BoardGetBatteryLevel;
                LoRaMacInitialization( &LoRaMacPrimitives, &LoRaMacCallbacks, ACTIVE_REGION );
                gpio_write(GPIO_USING,Signal_LED,GPIO_LEVEL_LOW);
                TimerInit( &TxNextPacketTimer, OnTxNextPacketTimerEvent );

                mibReq.Type = MIB_ADR;
                mibReq.Param.AdrEnable = LORAWAN_ADR_ON;
                LoRaMacMibSetRequestConfirm( &mibReq );

                mibReq.Type = MIB_PUBLIC_NETWORK;
                mibReq.Param.EnablePublicNetwork = LORAWAN_PUBLIC_NETWORK;
                LoRaMacMibSetRequestConfirm( &mibReq );
                
                // mibReq.Type = MIB_RECEIVE_DELAY_1; // Set the MIB type to RX1 delay
               // mibReq.Param.ReceiveDelay1 = 1000;
               // LoRaMacMibSetRequestConfirm( &mibReq );

                 //   mibReq.Type = MIB_RECEIVE_DELAY_2; // Set the MIB type to RX1 delay
               // mibReq.Param.ReceiveDelay2 = 0000;
              //  LoRaMacMibSetRequestConfirm( &mibReq );
                printf(" device state init \n");
                lwan_dev_params_update();
                
                DeviceState = DEVICE_STATE_JOIN;
                break;
            }
            case DEVICE_STATE_JOIN:
            {
#if( OVER_THE_AIR_ACTIVATION != 0 )
                MlmeReq_t mlmeReq;

                // Initialize LoRaMac device unique ID
                //BoardGetUniqueId( DevEui );

                            mlmeReq.Type = MLME_JOIN;
                    printf(" device state join \n");
                mlmeReq.Req.Join.DevEui = DevEui;
                mlmeReq.Req.Join.AppEui = AppEui;
                mlmeReq.Req.Join.AppKey = AppKey;
                mlmeReq.Req.Join.NbTrials = 8;

                if( LoRaMacMlmeRequest( &mlmeReq ) == LORAMAC_STATUS_OK )
                {
                    DeviceState = DEVICE_STATE_SLEEP;
                    printf(" LoRaMacMlmeRequest( &mlmeReq ) == LORAMAC_STATUS_OK \n");
                }
                else
                {
                  //  gpio_toggle(GPIO_USING,Signal_LED);
                    DeviceState = DEVICE_STATE_CYCLE;

                    printf(" LoRaMacMlmeRequest( &mlmeReq ) != LORAMAC_STATUS_OK \n");

                }
#else

                mibReq.Type = MIB_NET_ID;
               
                mibReq.Param.NetID = LORAWAN_NETWORK_ID;
                LoRaMacMibSetRequestConfirm( &mibReq );

                mibReq.Type = MIB_DEV_ADDR;
                mibReq.Param.DevAddr = DevAddr;
                LoRaMacMibSetRequestConfirm( &mibReq );

                mibReq.Type = MIB_NWK_SKEY;
                mibReq.Param.NwkSKey = NwkSKey;
                LoRaMacMibSetRequestConfirm( &mibReq );

                mibReq.Type = MIB_APP_SKEY;
                mibReq.Param.AppSKey = AppSKey;
                LoRaMacMibSetRequestConfirm( &mibReq );

                mibReq.Type = MIB_NETWORK_JOINED;
                mibReq.Param.IsNetworkJoined = true;
                LoRaMacMibSetRequestConfirm( &mibReq );

                DeviceState = DEVICE_STATE_SEND;
#endif
                break;
            }
            case DEVICE_STATE_SEND:
            {
                if( (NextTx == true && interrupt_flag==1) )//|| mlme_confirm==true )
                {   
                  //  if (mlme_confirm)
                    //    printf(" mlme confirm true \n");
                      //  else
                       // printf(" mlme confirm false \n");

                   // mlme_confirm=false;
                      last_ir_state=gpio_read(GPIO_USING,ir_pin);
                        last_ir_state_slot4=gpio_read(GPIO_USING,ir_pin_slot4);
                    PrepareTxFrame( AppPort ,last_ir_state,last_ir_state_slot4);
                    printf(" last_ir_State in device state send %d",last_ir_state);
                    printf(" last_ir_State_4 in device state send %d",last_ir_state_slot4);
                    
                    NextTx = SendFrame( );
                    if(mlme_received==1 && gateway_response_yet==false)
                   gpio_toggle(GPIO_USING,Signal_LED);


                    send_flag=1;
                }
                gateway_response_yet=false;
                // Schedule next packet transmission
                TxDutyCycleTime = APP_TX_DUTYCYCLE + randr( 0, APP_TX_DUTYCYCLE_RND );
                DeviceState = DEVICE_STATE_CYCLE;
                break;
            }

           



            case DEVICE_STATE_CYCLE:
            {
                printf(" Device state cycle \n");
                DeviceState = DEVICE_STATE_SLEEP;
                   // gpio_toggle(GPIO_USING,Signal_LED);
                // Schedule next packet transmission
                TimerSetValue( &TxNextPacketTimer, TxDutyCycleTime );
                TimerStart( &TxNextPacketTimer );
              
                break;
            }
            case DEVICE_STATE_SLEEP:
            {
                // Wake up through events
               // TimerLowPowerHandler( );
               // printf(" Device state sleep \n");
                // Process Radio IRQ
                if (mlme_received==0 )
              {  count_toggle++;
                //printf("vai \n");
                
              


                if (count_toggle==50000)
                {
                  //  printf(" does toggle \n");
                    count_toggle=0;
                gpio_toggle(GPIO_USING,Signal_LED);
                }

              }
                Radio.IrqProcess( );
                break;
            }
            default:
            {
                DeviceState = DEVICE_STATE_INIT;
                break;
            }
        }
    }
}
