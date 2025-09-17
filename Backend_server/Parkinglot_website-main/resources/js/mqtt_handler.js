console.log("doing mqtt");
import mqtt from 'mqtt';

/***
 * Browser
 * This document explains how to use MQTT over WebSocket with the ws and wss protocols.
 * EMQX's default port for ws connection is 8083 and for wss connection is 8084.
 * Note that you need to add a path after the connection address, such as /mqtt.
 */
const url = 'wss://9c5f236efa1d446c94d326c9a8b53a85.s1.eu.hivemq.cloud:8884/mqtt';  // Đổi port và sử dụng WebSocket

// Create an MQTT client instance
const options = {
    protocol: 'mqtts',  // Bạn vẫn có thể để mqtts vì WebSocket với SSL/TLS là mqtts
    username: 'khongbietmatkhau',
    password: 'Khongbiettaikhoan123@'
};

const client = mqtt.connect(url, options);

client.on('connect', function () {
  console.log('Connected');
  // Subscribe to a topic
  client.subscribe('test/something', function (err) {
    if (!err) {
      // Publish a message to a topic
      client.publish('test/something', 'Hello mqtt');
    }
  });
});

// Receive messages
client.on('message', function (topic, message) {
  // message is Buffer
  console.log(message.toString());
  client.end();
});
