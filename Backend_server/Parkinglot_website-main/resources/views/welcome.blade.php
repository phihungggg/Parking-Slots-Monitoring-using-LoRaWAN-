<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
     <!-- Fonts -->
     <link rel="preconnect" href="https://fonts.bunny.net">
     <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> 

    <style>
        /* Default mobile-first styles */
        body {
        
    font-family: 'Figtree', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
   width: 120%
}



header img {
    width: 190px;
    height: 60px;
}



header {
    background-color: #0a0944;
    color: white;
    height: 70px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 20px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    border-bottom: 4px solid green;
    width : 100%;
    position: fixed;
}



.reservation{

    background-color: #4ade80; /* bg-green-400 */
    color: #000000; /* text-black */
    border-radius: 0.375rem; /* rounded-md */
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 
                0 4px 6px -2px rgba(0, 0, 0, 0.05); /* shadow-lg */
    padding-left: 0.5rem; /* px-2 */
    padding-right: 0.5rem;
    padding-top: 0.25rem; /* py-1 */
    padding-bottom: 0.25rem;
    margin-top: 1.25rem; /* mt-5 */
    margin-right: 1.5rem; /* mr-2 */
    margin-bottom: 0.5rem; /* mb-2 */
    

}


.login{

    margin-top: 1.5rem; /* mt-6 */
    margin-left: auto; /* ml-auto */
    margin-right: 0.5rem; /* mr-2 */
    color: #ffffff; /* text-white */

}

.anhnenogiua{


    background-color: #0a0944
}
img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
}


.image_something{

    max-width: 100%; 
    height: auto;

}
@media (min-width: 768px) {
   
  
   
    body {
        
        font-family: 'Figtree', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
       width: 100%
    }
 
}

@media (min-width: 1024px) {
   
  
   
  .hehe {
       
      
      width: 300px
   }

}



@media (max-width: 1024px) {
  
.hehe{

    width: 80%;
    
}

    </style>

     <!-- Scripts -->
     @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Document</title>
</head>
<body>
    <header class="bg-[#0a0944] text-white h-[70px] flex justify-between items-center px-5 shadow-md fixed w-full border-b-4 border-green-500 md:h-[80px] md:px-10 md:shadow-lg">
        <a href="/" >
        <img src="{{ asset('images/Artboard22.png') }}" alt="Park Ease Logo">
    </a>
        <livewire:welcome.navigation />
    </header>

    <div class="bg-[#0a0944] anhnenogiua" style="   width: 100%; height: 1500px;   display: flex; flex-direction: column; justify-content: center; align-items: center;">
        <a href='{{ route('map') }}' style="color:black;  " >
        <div style="background-color: #4ade80; border-radius:4em; padding: 1em">
        
                       <p >Go to parking slots</p> 
                    
        </div>
    </a>

     </div>





<div style="background-color: white; display: flex; flex-direction: column; justify-content: center; align-items: center; width: 100%; height: 500px;">
    <div class="mb-5 hehe" style="height: 50px; background-color: lightblue; border-radius: 3em; display: flex; justify-content: center; align-items: center;">
    <p>
       We're the most accurate parking system
    </p>
</div>
    <img  class="lg:w-1/2" src="{{ asset('images/aroundtheworld.png') }}" alt="Around the world" style="image_something">
</div>




</body>
</html>
