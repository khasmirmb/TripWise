@include('admin.partials.header')

    @include('admin.components.navigation')

    @include('admin.components.sidebar')

    <main class="p-4 md:ml-64 pt-20">
        <div class="rounded-lg mb-4 shadow-md">
            <div class="relative bg-white dark:bg-gray-800 rounded-t-lg">
                <form action="{{route('admin.check.booking')}}" method="POST" id="scan-form">
                    @csrf
                    <div class="grid sm:grid-cols-2 w-full px-5 pt-5 gap-4 sm:gap-8">
                        <div class="w-full sm:col-span-2">
                            <label for="reference" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Booking Reference ID</label>
                            <input type="text" id="reference" name="reference" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" placeholder="Scan QR" readonly value="{{ old('reference') }}" required>
                            @error('reference')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                            @enderror 
                        </div>
                    </div>
                </form>
                <div class="w-full p-5">
                    <video id="preview" class="w-full h-full rounded-lg border border-gray-900 dark:border-white"></video>
                </div>
                <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
                <script type="module">
                    var scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod: 5, mirror: false });
                    scanner.addListener('scan',function(content){
                        document.getElementById('reference').value = content;

                        var form = document.getElementById('scan-form'); 
                        form.submit();
                    });
                    Instascan.Camera.getCameras().then(function (cameras){
                        if(cameras.length>0){
                            scanner.start(cameras[0]);
                            $('[name="options"]').on('change',function(){
                                if($(this).val()==1){
                                    if(cameras[0]!=""){
                                        scanner.start(cameras[0]);
                                    }else{
                                        alert('No Front camera found!');
                                    }
                                }else if($(this).val()==2){
                                    if(cameras[1]!=""){
                                        scanner.start(cameras[1]);
                                    }else{
                                        alert('No Back camera found!');
                                    }
                                }
                            });
                        }else{
                            console.error('No cameras found.');
                            alert('No cameras found.');
                        }
                    }).catch(function(e){
                        console.error(e);
                        alert(e);
                    });
                </script>
                
                <div class="flex p-5 w-full space-x-5">
                    <div class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700 w-full">
                        <input id="front-cam" type="radio" name="options" value="1" autocomplete="off" checked class="w-4 h-4 text-teal-600 bg-gray-100 border-gray-300 focus:ring-teal-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="front-cam" class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Front Camera</label>
                    </div>
                    <div class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700 w-full">
                        <input id="back-cam" type="radio" name="options" value="2" autocomplete="off" class="w-4 h-4 text-teal-600 bg-gray-100 border-gray-300 focus:ring-teal-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="back-cam" class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Back Camera</label>
                    </div>
                </div>
            </div>
        </div>
    </main>

@include('admin.partials.footer') 