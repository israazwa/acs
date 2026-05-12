<div class="p-2 md:p-8">
    <section class=" py-5 md:py-12">
        <div class="container mx-auto px-6 lg:px-12">
            <div class="flex flex-col-reverse lg:flex-row items-center gap-12 mx-5">

                <!-- Teks Hero -->
                <div class="w-full lg:w-1/2 text-center lg:text-left">
                    <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight gap-3"
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
                        data-aos="fade-down"
                    >
                        <span x-text="greeting"></span> <br>
                        Lorem ipsum dolor sit.
                    </h1>

                    <p class="mt-6 text-lg text-gray-600" data-aos="fade-down" data-aos-delay="200">
                       Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione quibusdam fugit aperiam animi ut tempora ab autem facilis perspiciatis ipsam?
                    </p>

                    <div class="mt-8 flex flex-col sm:flex-row justify-center lg:justify-start gap-4">
                        <a href="/login" 
                           class="px-20 py-3 text-lg font-semibold text-indigo-600 border border-indigo-600 rounded-lg hover:bg-indigo-100 transition" data-aos="fade-down" data-aos-delay="200">
                            Login Siswa
                        </a>
                        <a href="/loginAdmin" 
                           class="px-20 py-3 text-lg font-semibold text-orange-600 border border-orange-600 rounded-lg hover:bg-green-100 hover:text-green-700 hover:border-green-600 transition" data-aos="fade-down" data-aos-delay="400">
                            Login Admin
                        </a>
                    </div>
                </div>

                <!-- Gambar Hero -->
                <div class="w-full lg:w-1/2 flex justify-center">
                    <img src="{{ asset('hero.png') }}" 
                        alt="Ilustrasi Livestreaming LMS" 
                        class="rounded-xl" data-aos="fade-up">
                </div>


            </div>
        </div>
    </section>
</div>
