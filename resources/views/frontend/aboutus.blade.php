@extends('frontend.layouts.app')

@section('title')
    {{ __('About Us') }}
@endsection

@section('content')
<section class="bg-white dark:bg-gray-800 text-gray-600 body-font relative">
    <div class="absolute inset-0 bg-cover bg-center z-0" 
         style="background-image: url('{{ asset('img/Wallpaper/wallpapertugu.jpg') }}'); 
            opacity: 0.4;">
    </div>
    <div class="container mx-auto flex px-5 py-20 items-center justify-center flex-col relative z-10">
        <img class="lg:w-2/6 md:w-3/6 w-5/6 mb-10 object-cover object-center rounded" alt="hero" src="{{ asset('img/JOGCARE1000.png') }}">
        <!-- <div class="text-center lg:w-2/3 w-full">
        <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900 dark:text-white dark:text-white">About JogjaCare</h1>
        <p class="mb-8 leading-relaxed text-gray-800 dark:text-gray-300">Meggings kinfolk echo park stumptown DIY, kale chips beard jianbing tousled. Chambray dreamcatcher trust fund, kitsch vice godard disrupt ramps hexagon mustache umami snackwave tilde chillwave ugh. Pour-over meditation PBR&amp;B pickled ennui celiac mlkshk freegan photo booth af fingerstache pitchfork.</p>
        </div> -->
    </div>
    </section>

    <section class="text-gray-600 body-font">
    <div class="container mx-auto flex px-5 pt-20 items-center justify-center flex-col relative z-10">
        <!-- <img class="lg:w-2/12 md:w-3/12 w-5/12 mb-10 object-cover object-center rounded" alt="hero" src="{{ asset('img/JOGCARE1000.png') }}"> -->
        <div class="text-center lg:w-2/3 w-full">
        <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-blue-500">About JogjaCare</h1>
        <!-- <p class="mb-8 leading-relaxed text-gray-800 dark:text-gray-300">Meggings kinfolk echo park stumptown DIY, kale chips beard jianbing tousled. Chambray dreamcatcher trust fund, kitsch vice godard disrupt ramps hexagon mustache umami snackwave tilde chillwave ugh. Pour-over meditation PBR&amp;B pickled ennui celiac mlkshk freegan photo booth af fingerstache pitchfork.</p> -->
        </div>
    </div>
    <div class="container py-4 mx-auto">
        <div class="px-24 w-full mx-auto text-center">
        <!-- <p class="leading-relaxed text-lg">JogjaCare is the latest innovation in Yogyakarta's tourism landscape, combining healthcare excellence with the city's cultural charm. As a health tourism platform, JogjaCare bridges the gap between tourists looking for a unique holiday experience and the quality health facilities available in Student City.
        This website is here as a comprehensive solution for those who want to use their vacation not only to relax, but also to improve their health and fitness. By leveraging Yogyakarta's reputation as a popular tourist destination and the development of its health infrastructure, JogjaCare offers a holistic tourism experience.
        <br><br>Through an intuitive interface, website visitors can explore a variety of healthcare options, from routine check-ups to more complex medical procedures. JogjaCare not only provides information about leading hospitals and clinics in Yogyakarta, but also helps tourists in planning their trips by offering packages that combine medical care with cultural exploration.
        JogjaCare's uniqueness lies in its ability to integrate health aspects with the rich culture of Yogyakarta. Visitors can find recommendations for suitable tourist attractions to visit between their treatment schedules, ensuring that their trip not only benefits their health, but also enriches their cultural insight.
        <br><br>With JogjaCare, Yogyakarta positions itself as a promising health tourism destination in Indonesia. This platform not only supports the development of the local tourism industry, but also contributes to improving health services in the area. Through collaboration between the tourism and health sectors, JogjaCare creates a mutually beneficial ecosystem, encouraging economic growth and improving service standards in both sectors.
        As a pioneer in its field, JogjaCare is paving the way for the development of health tourism in Indonesia, demonstrating the great potential this country has in attracting international medical tourists. By prioritizing service quality and local wisdom, JogjaCare is not only an information portal, but also an ambassador for the excellence of health services and friendly culture of Yogyakarta.</p> -->
        <p class="leading-relaxed text-lg dark:text-gray-100">JogjaCare is the latest innovation in Yogyakarta's tourism landscape, combining healthcare excellence with the city's cultural charm. As a health tourism platform, JogjaCare bridges the gap between tourists looking for a unique holiday experience and the quality health facilities available in Student City.
        This website is here as a comprehensive solution for those of you who want to use your vacation not only to relax, but also to improve your health and fitness. By leveraging Yogyakarta's reputation as a popular tourist destination and the development of its health infrastructure, JogjaCare offers a holistic tourism experience.
        <br><br>JogjaCare not only provides information about leading hospitals and clinics in Yogyakarta, but also helps tourists in planning their trips by offering packages that combine medical care with tourist exploration.
        JogjaCare's uniqueness lies in its ability to integrate health aspects with the rich culture of Yogyakarta. Visitors can find recommendations for suitable tourist attractions to visit between their treatment schedules, ensuring their trip not only benefits their health, but also enriches their cultural insight.
        <br><br>With JogjaCare, Yogyakarta is positioning itself as a promising health tourism destination in Indonesia. This platform not only supports the development of the local tourism industry, but also contributes to improving health services in the area. Through collaboration between the tourism and health sectors, JogjaCare creates a mutually beneficial ecosystem, and as a pioneer in its field, JogjaCare paves the way for the development of health tourism in Indonesia, showing the country's enormous potential in attracting international medical tourists. By prioritizing service quality and local wisdom, JogjaCare is not only an information portal, but also an ambassador for health service excellence and Yogyakarta's friendly culture.</p>
        <span class="inline-block h-1 w-10 rounded bg-blue-500 mt-8 mb-6"></span>
        <h2 class="text-gray-900 dark:text-white font-medium title-font tracking-wider text-sm mb-20">JogjaCare's Team</h2>
        </div>
    </div>
    </section>

    <section class="bg-blue-100 text-gray-600 body-font dark:bg-gray-700 dark:text-gray-400 overflow-hidden">
    <div class="container px-5 py-24 mx-auto">
        <div class="flex flex-wrap -m-12">
        <div class="p-12 md:w-1/2 flex flex-col items-start">
        <span class="inline-block py-1 px-2 mb-4 rounded bg-blue-500 text-white text-xs font-medium tracking-widest">Our Vision</span>
        <h2 class="sm:text-3xl text-2xl title-font font-medium text-gray-900 dark:text-white mt-4 mb-4">"To be the leading platform connecting tourists with quality health services in Yogyakarta, combining the cultural beauty and friendliness of the city with modern medical care."
            <br><br>This vision includes several important aspects:</h2>
        <p class="leading-relaxed mb-8 dark:text-gray-300">1. Position as the main platform for health tourism
        <br> 2. Focus on Yogyakarta as a destination
        <br> 3. Emphasis on the quality of health services
        <br> 4. Integration between tourism and medical care
        <br> 5. Highlighting the unique culture and hospitality of Yogyakarta</p>
        </div>
        <div class="p-12 md:w-1/2 flex flex-col items-start">
        <span class="inline-block py-1 px-2 mb-4 rounded bg-blue-500 text-white text-xs font-medium tracking-widest">Our Mission</span>
        <h2 class="sm:text-3xl text-2xl title-font font-medium text-gray-900 dark:text-white mt-4 mb-4">"To be a trusted bridge connecting tourists with quality health services in Yogyakarta, while promoting the cultural richness and natural beauty of this area."
            <br><br>This mission includes several important aspects:</h2>
        <p class="leading-relaxed mb-8 dark:text-gray-300"> 1. Connecting tourists with health services
        <br> 2. Guarantee the quality of the services offered
        <br> 3. Promote Yogyakarta as a health tourism destination
        <br> 4. Combining health aspects with culture and style</p>
        </div>
        </div>
    </div>
    </section>

    <section class="bg-white dark:bg-gray-800 text-gray-600 body-font">
    <div class="container px-5 py-24 mx-auto">
    <div class="flex flex-col text-center w-full mb-20">
    <h1 class="text-2xl font-medium title-font mb-4 text-blue-500">MEET OUR TEAM</h1>
    <p class="lg:w-2/3 mx-auto leading-relaxed text-base dark:text-gray-200">At JogjaCare, we have a team of professionals dedicated to providing the best health experience for you. Carefully selected to combine the latest medical expertise with typical Jogja hospitality.</p>
    </div>
    <div class="flex flex-wrap -m-4">
    <!-- Single row of 6 team members -->
    <div class="p-4 lg:w-1/6 md:w-1/3 sm:w-1/2">
        <div class="h-full flex flex-col items-center text-center">
        <img alt="team" class="flex-shrink-0 rounded-lg w-full h-40 object-cover object-center mb-4" src="img/profile/ais.jpg">
        <div class="w-full">
        <h2 class="title-font font-medium text-lg text-gray-900 dark:text-white">Aisyah Humairah</h2>
        <h3 class="text-gray-500 dark:text-gray-300 mb-3">Project Manager</h3>
        <p class="mb-4 px-2 dark:text-gray-100 text-sm h-16">"Everyone has their moment, every era has its name — But make yours the one that echoes."</p>
        <span class="inline-flex">
        <a class="text-gray-500 dark:text-gray-300 hover:text-blue-500" href="https://www.instagram.com/syamairhh" target="_blank">
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
            <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
            </svg>
        </a>
        </span>
        </div>
        </div>
    </div>
    <div class="p-4 lg:w-1/6 md:w-1/3 sm:w-1/2">
        <div class="h-full flex flex-col items-center text-center">
        <img alt="team" class="flex-shrink-0 rounded-lg w-full h-40 object-cover object-center mb-4" src="img/profile/badrun.jpg">
        <div class="w-full">
        <h2 class="title-font font-medium text-lg text-gray-900 dark:text-white">Badrun Nafis</h2>
        <h3 class="text-gray-500 dark:text-gray-300 mb-3">Tester</h3>
        <p class="mb-4 px-2 dark:text-gray-100 text-sm h-16">"Success is not final, failure is not fatal: It's the courage to continue that counts."</p>
        <span class="inline-flex">
        <a class="text-gray-500 dark:text-gray-300 hover:text-blue-500" href="https://www.instagram.com/dun_drun" target="_blank">
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
            <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
            </svg>
        </a>
        </span>
        </div>
        </div>
    </div>
    <div class="p-4 lg:w-1/6 md:w-1/3 sm:w-1/2">
        <div class="h-full flex flex-col items-center text-center">
        <img alt="team" class="flex-shrink-0 rounded-lg w-full h-40 object-cover object-center mb-4" src="img/profile/nabil.jpg">
        <div class="w-full">
        <h2 class="title-font font-medium text-lg text-gray-900 dark:text-white">Nabila Humayra A.Z.</h2>
        <h3 class="text-gray-500 dark:text-gray-300 mb-3">Content Writer</h3>
        <p class="mb-4 px-2 dark:text-gray-100 text-sm h-16">"Words have the power to change perspectives and touch hearts."</p>
        <span class="inline-flex">
        <a class="text-gray-500 dark:text-gray-300 hover:text-blue-500" href="https://www.instagram.com/nbillahmayra" target="_blank">
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
            <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
            </svg>
        </a>
        </span>
        </div>
        </div>
    </div>
    <div class="p-4 lg:w-1/6 md:w-1/3 sm:w-1/2">
        <div class="h-full flex flex-col items-center text-center">
        <img alt="team" class="flex-shrink-0 rounded-lg w-full h-40 object-cover object-center mb-4" src="img/profile/zufar.jpg">
        <div class="w-full">
        <h2 class="title-font font-medium text-lg text-gray-900 dark:text-white">Muhammad Zufar A.</h2>
        <h3 class="text-gray-500 dark:text-gray-300 mb-3">System Analyst</h3>
        <p class="mb-4 px-2 dark:text-gray-100 text-sm h-16">"Start by building your personal branding."</p>
        <span class="inline-flex">
        <a class="text-gray-500 dark:text-gray-300 hover:text-blue-500" href="https://instagram.com/zufaralhabsy" target="_blank">
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
            <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
            </svg>
        </a>
        </span>
        </div>
        </div>
    </div>
    <div class="p-4 lg:w-1/6 md:w-1/3 sm:w-1/2">
        <div class="h-full flex flex-col items-center text-center">
        <img alt="team" class="flex-shrink-0 rounded-lg w-full h-40 object-cover object-center mb-4" src="img/profile/melati.jpg">
        <div class="w-full">
        <h2 class="title-font font-medium text-lg text-gray-900 dark:text-white">Melati Ayu S.</h2>
        <h3 class="text-gray-500 dark:text-gray-300 mb-3">Programmer</h3>
        <p class="mb-4 px-2 dark:text-gray-100 text-sm h-16">"With code we build bridges between imagination and reality."</p>
        <span class="inline-flex">
        <a class="text-gray-500 dark:text-gray-300 hover:text-blue-500" href="https://www.instagram.com/melatii_ayuu" target="_blank">
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
            <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
            </svg>
        </a>
        </span>
        </div>
        </div>
    </div>
    <div class="p-4 lg:w-1/6 md:w-1/3 sm:w-1/2">
        <div class="h-full flex flex-col items-center text-center">
        <img alt="team" class="flex-shrink-0 rounded-lg w-full h-40 object-cover object-center mb-4" src="img/profile/mac.jpg">
        <div class="w-full">
        <h2 class="title-font font-medium text-lg text-gray-900 dark:text-white">MCALLISTER</h2>
        <h3 class="text-gray-500 dark:text-gray-300 mb-3">Programmer</h3>
        <p class="mb-4 px-2 dark:text-gray-100 text-sm h-16">"We're told to be ourselves, but judged by someone else's standards."</p>
        <span class="inline-flex">
        <a class="text-gray-500 dark:text-gray-300 hover:text-blue-500" href="https://www.instagram.com/fauzanannass" target="_blank">
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
            <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
            </svg>
        </a>
        </span>
        </div>
        </div>
    </div>
    </div>
    </div>
    </section>
@endsection
