<div>
    <section class="p-12 md:p-20">
        <div class="container mx-auto px-6 lg:px-12 mx-5">
            <div class="flex flex-col-reverse lg:flex-row items-center gap-12">

                <!-- Teks Hero -->
                <div class="w-full lg:w-1/2 text-center lg:text-left">
                    <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight fade-up"
                    
                        x-data="{ greeting: '' }"
                        x-init="
                            const hour = new Date().getHours();
                            if(hour >= 5 && hour < 11){
                                greeting = 'Selamat Pagi';
                            } else if(hour >= 11 && hour < 15){
                                greeting = 'Selamat Siang';
                            } else if(hour >= 15 && hour < 18){
                                greeting = 'Selamat Sore';
                            } else {
                                greeting = 'Selamat Malam';
                            }
                        "
                    >
                        <span x-text="greeting"></span>, {{ Auth::user()->name }} 
                    </h1>

                    <p class="mt-6 text-lg text-gray-600 fade-down">
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorem quam, minus veritatis alias totam earum corrupti quae itaque, architecto officiis repudiandae, similique deleniti!
                    </p>


                    <div class="mt-8 flex flex-col sm:flex-row justify-center lg:justify-start gap-4 fade-down">
                        <a href="/kelas"
                           class="px-20 py-3 text-lg font-semibold text-orange-600 border border-orange-600 rounded-lg hover:bg-orange-100 transition">
                            Masuk Kelas
                        </a>
                    </div>
                </div>

                <!-- Gambar Hero -->
                <div class="w-full lg:w-1/2 flex justify-center">
                    <img src="{{ asset('hero.png') }}" 
                        alt="Ilustrasi Livestreaming LMS" 
                        class="rounded-xl fade-up"
                        >
                </div>


            </div>
        </div>
    </section>
</div>
