<template>
  <div>

    <!--Partie edite-->
  <transition name="slide-fade">
        <div v-show="hidden" class=" fixed flex items-center" style=" z-index:5; width: 100%; height: 80%">
            <div class="w-full h-screen mx-auto relative">
            <div class="bg-white backdrop-filter backdrop-blur-lg opacity-75 w-full h-full absolute"></div>
            <div class="w-full h-full relative  mx-auto" style=" z-index: 5;">
                <div class=" w-4/5 h-full flex items-center">
                    <div class="md:w-2/5 w-4/5 mt-3 mx-auto " style=" z-index: 5;">
                    <div class=" w-full h-auto pb-2 mt-16 items-center bg-white shadow-2xl rounded-xl" style=" z-index: 5;">
                        <!--header-->
                        <div class="w-full font-bold text-xl flex">
                            <p class="mx-auto text-white"></p>
                            <button @click="hidden = false"  class="bg-blue-500 flex items-center text-white h-8 w-8 rounded-full transform -translate-y-6 translate-x-4">
                                <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                            </button>
                            
                        </div>

                        <!--body-->
                        
                        <div class="w-full h-auto px-2">
                             <div class="w-full h-auto flex">
                                <div class="w-auto h-auto space-y-3 mx-auto">
                                    
                                    <div >
                                        <div class="flex w-full h-auto">
                                            <div v-if="editLoading == 'non'" class="flex w-full h-auto" >
                                                <div  class=" flex justify-center items-center mx-auto">
                                                    <div class="animate-spin rounded-full h-20 w-20 border-t-2 border-b-2 border-blue-500"></div>
                                                </div>
                                            </div>
                                            <svg v-if="editLoading == 'oui'" class="w-20 h-20 mx-auto mb-4 rounded-full border-blue-500 border-2" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                    viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
                                                <circle style="fill:#fff;" cx="25" cy="25" r="25"/>
                                                <polyline style="fill:none;stroke:#5962DF;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;" points="
                                                    38,15 22,33 12,25 "/>
                                            </svg>
                                        </div>
                                        <p class=" text-center text-sm text-gray-500">Voulez allez modifier le statut de cette utilisateur</p>
                                        <form @submit.prevent="editUser(param.idEdit)" class=" space-y-6">
                                            <div class="w-full h-full mt-4">
                                                <select  v-model="param.statut" class="border w-full h-full bg-white text-black py-2 px-3 text-grey-800">
                                                    <option  value="">Choisissez un statut</option>
                                                    <option>Utilisateur</option>
                                                    <option>Createur</option>
                                                    <option>Admin</option>
                                                </select>
                                            </div>
                                            <div class=" w-full flex">
                                                <button type="submit" @click="editLoading = 'non'" class=" bg-blue-500 px-4 py-3 text-white hover:bg-blue-300 mx-auto rounded-lg">Modifier</button>
                                            </div>
                                        </form>
                                    </div>
                                    
                                </div>
                             </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </transition>

    <!--Partie Loading page-->
    <div v-if="this.loading && this.errors == ''"  class="w-full h-full fixed flex items-center bg-gray-300 opacity-60">
        <div class="justify-center w-1/2 relative">
            <div class="animate-spin rounded-full h-32 w-32 border-t-2 border-b-2 absolute right-10 bottom-0 border-purple-500"></div>
        </div>
    </div>

            <!--Partie Non authentifier-->
    <div v-if="this.errors">
        <div class=" w-full h-screen bg-white flex items-center">
            <div class="mx-auto space-y-8">
                <p class=" text-5xl text-gray-500">Authentifiez vous pour travailler</p>
                <div class="w-full flex">
                    <button @click="pageLogin" class="text-white mx-auto px-4 py-3 rounded-xl bg-gray-700 hover:bg-gray-500">page de connexion</button>
                </div>
            </div>
        </div>
    </div>

    <!--Partie Statistique-->
    <div v-if="this.errors == '' ">
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
        <header class="fixed w-full lg:w-4/5 flex justify-between items-center py-4 px-6  bg-white border-b-4 border-indigo-600">
            <div class="flex items-center">
                <button  class="text-gray-500 focus:outline-none lg:hidden">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>
                </button>

                <div class="relative mx-4 lg:mx-0">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <svg class="h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                        </svg>
                    </span>

                    <input @keyup="search" v-model="name" class="form-input w-32 sm:w-64 rounded-md pl-10 pr-4 focus:border-indigo-600" type="text"
                        placeholder="Search">
                </div>
            </div>

            <div class="flex items-center">
                <div x-data="{ notificationOpen: false }" class="relative">
                    <button 
                        class="flex mx-4 text-gray-600 focus:outline-none">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M15 17H20L18.5951 15.5951C18.2141 15.2141 18 14.6973 18 14.1585V11C18 8.38757 16.3304 6.16509 14 5.34142V5C14 3.89543 13.1046 3 12 3C10.8954 3 10 3.89543 10 5V5.34142C7.66962 6.16509 6 8.38757 6 11V14.1585C6 14.6973 5.78595 15.2141 5.40493 15.5951L4 17H9M15 17V18C15 19.6569 13.6569 21 12 21C10.3431 21 9 19.6569 9 18V17M15 17H9"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                        </svg>
                    </button>

                    <div x-show="notificationOpen" 
                        class="fixed inset-0 h-full w-full z-10" style="display: none;"></div>

                    <div x-show="notificationOpen"
                        class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl overflow-hidden z-10"
                        style="width: 20rem; display: none;">
                        <a href="#"
                            class="flex items-center px-4 py-3 text-gray-600 hover:text-white hover:bg-indigo-600 -mx-2">
                            <img class="h-8 w-8 rounded-full bg-black object-cover mx-1"
                                src="/logos/logoblanc.png"
                                alt="avatar">
                            <p class="text-sm mx-2">
                                <span class="font-bold" href="#">Sara Salah</span> replied on the <span
                                    class="font-bold text-indigo-400" href="#">Upload Image</span> artical . 2m
                            </p>
                        </a>
                        <a href="#"
                            class="flex items-center px-4 py-3 text-gray-600 hover:text-white hover:bg-indigo-600 -mx-2">
                            <img class="h-8 w-8 rounded-full bg-black object-cover mx-1"
                                src="/logos/logoblanc.png"
                                alt="avatar">
                            <p class="text-sm mx-2">
                                <span class="font-bold" href="#">Slick Net</span> start following you . 45m
                            </p>
                        </a>
                        <a href="#"
                            class="flex items-center px-4 py-3 text-gray-600 hover:text-white hover:bg-indigo-600 -mx-2">
                            <img class="h-8 w-8 rounded-full bg-black object-cover mx-1"
                                src="/logos/logoblanc.png"
                                alt="avatar">
                            <p class="text-sm mx-2">
                                <span class="font-bold" href="#">Jane Doe</span> Like Your reply on <span
                                    class="font-bold text-indigo-400" href="#">Test with TDD</span> artical . 1h
                            </p>
                        </a>
                        <a href="#"
                            class="flex items-center px-4 py-3 text-gray-600 hover:text-white hover:bg-indigo-600 -mx-2">
                            <img class="h-8 w-8 bg-black rounded-full object-cover mx-1"
                                src="/logos/logoblanc.png"
                                alt="avatar">
                            <p class="text-sm mx-2">
                                <span class="font-bold" href="#">Abigail Bennett</span> start following you . 3h
                            </p>
                        </a>
                    </div>
                </div>

                <div x-data="{ dropdownOpen: false }" class="relative">
                    <button 
                        class="relative block h-8 w-8 rounded-full overflow-hidden shadow focus:outline-none">
                        <img class="h-full bg-black w-full object-cover"
                            src="/logos/logoblanc.png"
                            alt="Your avatar">
                    </button>

                    <div class="fixed inset-0 h-full w-full z-10"
                        style="display: none;"></div>

                    <div x-show="dropdownOpen"
                        class="absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl z-10"
                        style="display: none;">
                        <a href="#"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">Profile</a>
                        <a href="#"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">Products</a>
                        <a href="/login"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">Logout</a>
                    </div>
                </div>
            </div>
        </header>
        <div class="container mx-auto px-6 py-8 mt-4">
            <div class="mt-4">
                    <div class="flex flex-wrap -mx-6 space-y-6">
                        <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3">
                            <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                                <div class="p-3 rounded-full bg-indigo-600 bg-opacity-75">
                                    <svg class="h-8 w-8 text-white" viewBox="0 0 28 30" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M18.2 9.08889C18.2 11.5373 16.3196 13.5222 14 13.5222C11.6804 13.5222 9.79999 11.5373 9.79999 9.08889C9.79999 6.64043 11.6804 4.65556 14 4.65556C16.3196 4.65556 18.2 6.64043 18.2 9.08889Z"
                                            fill="currentColor"></path>
                                        <path
                                            d="M25.2 12.0444C25.2 13.6768 23.9464 15 22.4 15C20.8536 15 19.6 13.6768 19.6 12.0444C19.6 10.4121 20.8536 9.08889 22.4 9.08889C23.9464 9.08889 25.2 10.4121 25.2 12.0444Z"
                                            fill="currentColor"></path>
                                        <path
                                            d="M19.6 22.3889C19.6 19.1243 17.0927 16.4778 14 16.4778C10.9072 16.4778 8.39999 19.1243 8.39999 22.3889V26.8222H19.6V22.3889Z"
                                            fill="currentColor"></path>
                                        <path
                                            d="M8.39999 12.0444C8.39999 13.6768 7.14639 15 5.59999 15C4.05359 15 2.79999 13.6768 2.79999 12.0444C2.79999 10.4121 4.05359 9.08889 5.59999 9.08889C7.14639 9.08889 8.39999 10.4121 8.39999 12.0444Z"
                                            fill="currentColor"></path>
                                        <path
                                            d="M22.4 26.8222V22.3889C22.4 20.8312 22.0195 19.3671 21.351 18.0949C21.6863 18.0039 22.0378 17.9556 22.4 17.9556C24.7197 17.9556 26.6 19.9404 26.6 22.3889V26.8222H22.4Z"
                                            fill="currentColor"></path>
                                        <path
                                            d="M6.64896 18.0949C5.98058 19.3671 5.59999 20.8312 5.59999 22.3889V26.8222H1.39999V22.3889C1.39999 19.9404 3.2804 17.9556 5.59999 17.9556C5.96219 17.9556 6.31367 18.0039 6.64896 18.0949Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </div>

                                <div class="mx-5">
                                    <h4 class="text-2xl font-semibold text-gray-700">{{users.length}}</h4>
                                    <div class="text-gray-500">Utilisateurs</div>
                                </div>
                            </div>
                        </div>

                        <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 sm:mt-0">
                            <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                                <div class="p-3 rounded-full bg-orange-600 bg-opacity-75">
                                    <svg class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 1280.000000 1186.000000"
                                        preserveAspectRatio="xMidYMid meet">
                                        <g transform="translate(0.000000,1186.000000) scale(0.100000,-0.100000)"
                                        fill="#FFFFFF" stroke="none">
                                        <path d="M5595 11854 c-257 -19 -347 -27 -450 -40 -2514 -312 -4555 -2224
                                        -5039 -4720 -30 -154 -69 -442 -88 -639 -17 -181 -17 -786 0 -960 67 -687 189
                                        -1210 414 -1775 556 -1389 1556 -2467 2893 -3116 1211 -588 2540 -750 3820
                                        -468 780 172 1516 493 2150 937 55 39 105 70 110 70 21 -1 276 -123 386 -186
                                        390 -220 1199 -620 1429 -705 477 -177 980 -224 1424 -133 82 17 151 32 152
                                        34 4 4 -47 326 -87 552 -17 94 -43 250 -58 348 -16 97 -30 180 -33 182 -3 3
                                        -97 -2 -209 -11 -301 -26 -621 -23 -774 5 -360 66 -733 211 -1388 538 l-88 44
                                        82 87 c177 187 395 464 566 722 555 836 886 1779 979 2790 21 225 24 698 5
                                        915 -98 1174 -510 2247 -1230 3203 -175 232 -298 372 -545 617 -481 480 -947
                                        814 -1558 1115 -639 316 -1297 501 -2042 575 -141 15 -709 28 -821 19z m482
                                        -1145 c469 -65 887 -336 1135 -737 26 -42 46 -77 44 -79 -1 -1 -74 20 -162 47
                                        -272 86 -499 136 -804 177 -193 26 -744 26 -945 0 -261 -34 -494 -82 -730
                                        -151 -66 -19 -121 -34 -122 -32 -5 4 91 142 148 212 123 151 332 320 502 406
                                        140 70 322 128 482 153 101 16 349 18 452 4z m-3606 -2216 c-419 -550 -697
                                        -1188 -810 -1858 -23 -132 -47 -371 -59 -567 l-7 -128 -55 75 c-84 115 -145
                                        220 -195 336 -148 349 -164 753 -45 1119 142 435 506 818 929 977 82 31 220
                                        72 244 72 17 1 17 -1 -2 -26z m6819 -18 c262 -64 504 -197 706 -388 256 -242
                                        416 -542 475 -888 28 -162 23 -440 -10 -587 -45 -201 -122 -386 -229 -547 -59
                                        -88 -187 -245 -200 -245 -4 0 -8 80 -9 178 -10 818 -244 1573 -697 2256 -47
                                        71 -86 132 -86 137 0 4 -3 9 -7 11 -5 2 -25 24 -46 51 -46 57 -44 57 103 22z
                                        m41 -4998 c13 -189 -16 -419 -76 -602 -43 -133 -147 -330 -234 -445 -43 -58
                                        -89 -115 -102 -127 l-24 -22 -80 20 c-96 23 -205 34 -511 49 l-232 12 -143
                                        -85 c-227 -134 -403 -218 -593 -283 -112 -39 -85 -21 47 30 266 104 633 303
                                        872 472 383 273 734 626 1000 1006 33 47 62 84 64 82 3 -2 8 -50 12 -107z
                                        m-6856 -112 c248 -324 563 -629 903 -874 291 -209 745 -437 1095 -551 53 -17
                                        97 -33 97 -35 0 -9 -200 -68 -290 -86 -140 -29 -367 -35 -510 -15 -282 40
                                        -531 142 -754 311 -87 65 -238 217 -304 305 -206 275 -322 625 -322 972 0 45
                                        4 78 8 73 5 -6 39 -50 77 -100z m6905 -968 c0 -2 -10 -12 -22 -23 l-23 -19 19
                                        23 c18 21 26 27 26 19z m-160 -151 c0 -2 -8 -10 -17 -17 -16 -13 -17 -12 -4 4
                                        13 16 21 21 21 13z m-1998 -294 c4 -10 239 -72 448 -117 90 -20 166 -38 169
                                        -42 13 -13 -300 8 -393 27 -132 26 -336 93 -324 106 5 4 79 32 90 33 3 1 8 -3
                                        10 -7z m1118 -337 c0 -2 -10 -9 -22 -15 -22 -11 -22 -10 -4 4 21 17 26 19 26
                                        11z m-70 -40 c0 -3 -45 -27 -100 -55 -55 -28 -100 -48 -100 -45 0 4 186 102
                                        198 104 1 1 2 -1 2 -4z m-240 -125 c-19 -11 -39 -19 -45 -19 -5 0 6 8 25 19
                                        19 11 40 19 45 19 6 0 -6 -8 -25 -19z m-110 -50 c-8 -5 -19 -10 -25 -10 -5 0
                                        -3 5 5 10 8 5 20 10 25 10 6 0 3 -5 -5 -10z m-90 -40 c-8 -5 -19 -10 -25 -10
                                        -5 0 -3 5 5 10 8 5 20 10 25 10 6 0 3 -5 -5 -10z m-50 -20 c-8 -5 -19 -10 -25
                                        -10 -5 0 -3 5 5 10 8 5 20 10 25 10 6 0 3 -5 -5 -10z m-50 -20 c-8 -5 -19 -10
                                        -25 -10 -5 0 -3 5 5 10 8 5 20 10 25 10 6 0 3 -5 -5 -10z m-50 -20 c-8 -5 -19
                                        -10 -25 -10 -5 0 -3 5 5 10 8 5 20 10 25 10 6 0 3 -5 -5 -10z m-105 -40 c-27
                                        -12 -43 -12 -25 0 8 5 22 9 30 9 10 0 8 -3 -5 -9z m-758 -206 c-3 -3 -12 -4
                                        -19 -1 -8 3 -5 6 6 6 11 1 17 -2 13 -5z m-250 -40 c-3 -3 -12 -4 -19 -1 -8 3
                                        -5 6 6 6 11 1 17 -2 13 -5z m-400 -40 c-3 -3 -12 -4 -19 -1 -8 3 -5 6 6 6 11
                                        1 17 -2 13 -5z"/>
                                        </g>
                                    </svg>

                                </div>

                                <div class="mx-5">
                                    <h4 class="text-2xl font-semibold text-gray-700">{{series.length}}</h4>
                                    <div class="text-gray-500">Series</div>
                                </div>
                            </div>
                        </div>

                        <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 xl:mt-0">
                            <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                                <div class="p-3 rounded-full bg-pink-600 bg-opacity-75">
                                    <svg class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 1173.000000 1280.000000"
                                    preserveAspectRatio="xMidYMid meet">
                                    <g transform="translate(0.000000,1280.000000) scale(0.100000,-0.100000)"
                                    fill="#FFFFFF" stroke="none">
                                    <path d="M2714 12043 c-247 -416 -450 -762 -452 -768 -1 -6 260 -171 580 -367
                                    1240 -755 7797 -4754 7873 -4800 l80 -50 -50 7 c-52 7 -1269 208 -3570 590
                                    -748 124 -1751 291 -2230 370 -478 79 -1589 264 -2469 410 -879 146 -1602 265
                                    -1606 265 -4 0 -10 -24 -14 -52 -14 -112 -846 -5935 -851 -5963 l-7 -30 979
                                    -162 c3183 -529 4562 -758 5228 -868 2215 -367 3708 -615 3729 -621 22 -5 24
                                    -2 35 58 6 35 200 1390 431 3013 281 1965 426 2955 435 2965 7 8 212 349 454
                                    758 414 697 441 746 441 790 l0 47 -2043 1245 c-1123 685 -3029 1847 -4236
                                    2582 -2096 1278 -2196 1338 -2241 1338 l-47 0 -449 -757z m1218 86 c93 -56
                                    168 -105 168 -108 0 -3 -183 -115 -406 -247 l-405 -241 -160 100 c-87 55 -159
                                    102 -159 106 1 6 780 491 790 491 3 0 80 -46 172 -101z m1730 -2337 c1613
                                    -1006 3437 -2143 4053 -2527 616 -384 1130 -704 1142 -712 22 -14 21 -15 -38
                                    -113 l-60 -99 -177 108 c-97 59 -1007 614 -2022 1233 -1015 619 -2774 1691
                                    -3910 2383 -1136 692 -2071 1263 -2078 1270 -10 9 3 39 68 148 45 75 83 137
                                    85 137 3 0 1325 -823 2937 -1828z m-317 1476 c83 -50 156 -97 164 -103 11 -11
                                    -60 -57 -399 -259 -226 -135 -414 -246 -417 -246 -3 0 -79 46 -169 103 -159
                                    99 -164 102 -142 117 156 105 787 488 798 484 8 -3 83 -46 165 -96z m1575
                                    -967 c-1 -7 -817 -494 -837 -499 -12 -3 -313 177 -313 188 0 3 185 120 412
                                    261 l411 256 163 -100 c90 -55 164 -102 164 -106z m1229 -743 c83 -51 151 -95
                                    151 -98 -1 -9 -844 -505 -860 -505 -24 0 -291 168 -281 178 13 13 825 517 833
                                    517 4 0 75 -42 157 -92z m1388 -845 c89 -54 162 -101 163 -105 0 -4 -75 -52
                                    -167 -107 -93 -54 -289 -171 -437 -260 l-269 -161 -159 99 -159 99 318 198
                                    c175 109 367 228 428 266 60 37 112 68 115 68 3 0 78 -44 167 -97z m1553 -953
                                    c0 -6 -868 -524 -885 -528 -15 -4 -309 177 -301 185 3 3 199 126 436 273 l432
                                    269 159 -97 c87 -53 159 -99 159 -102z m-8965 -490 c567 -94 1246 -206 1510
                                    -250 264 -44 809 -134 1210 -200 1214 -201 2090 -346 2690 -445 314 -52 953
                                    -158 1420 -235 468 -77 1014 -168 1215 -200 201 -33 374 -62 386 -65 20 -4 20
                                    -5 -9 -122 -16 -65 -30 -119 -32 -121 -3 -3 -135 17 -2310 348 -291 44 -735
                                    112 -985 150 -1015 154 -1402 213 -1970 300 -327 50 -741 113 -920 140 -179
                                    27 -622 95 -985 150 -363 55 -806 123 -985 150 -909 138 -1314 200 -1317 204
                                    -2 1 0 87 3 189 7 183 8 186 28 182 12 -3 485 -82 1051 -175z m-310 -735 c684
                                    -99 849 -123 1548 -225 149 -22 801 -116 1447 -210 646 -94 1298 -188 1448
                                    -210 149 -22 395 -58 545 -80 149 -22 677 -98 1172 -170 865 -125 1136 -165
                                    1715 -249 146 -22 369 -54 495 -72 127 -18 233 -35 237 -38 4 -4 -12 -88 -36
                                    -186 -90 -363 -590 -2400 -667 -2715 -44 -179 -100 -406 -124 -505 -24 -99
                                    -95 -389 -158 -645 -63 -256 -125 -509 -138 -562 -15 -64 -28 -98 -36 -98 -8
                                    0 -204 34 -436 75 -232 41 -1369 241 -2527 445 -4539 800 -5382 949 -5384 952
                                    -1 2 4 221 11 488 6 267 21 856 33 1310 11 454 25 994 30 1200 5 206 14 560
                                    20 785 5 226 13 504 16 618 l7 208 26 -5 c14 -3 355 -53 756 -111z"/>
                                    <path d="M1756 6322 c-5 -9 -42 -276 -131 -957 -25 -192 -64 -487 -86 -655
                                    -87 -669 -120 -920 -164 -1255 -25 -192 -64 -483 -85 -645 -61 -463 -72 -561
                                    -67 -566 2 -3 150 -29 328 -60 178 -30 603 -102 944 -159 341 -58 805 -136
                                    1030 -174 226 -39 678 -115 1005 -170 327 -56 780 -132 1005 -170 226 -39 678
                                    -115 1005 -170 622 -106 1086 -184 1926 -326 276 -47 513 -85 528 -85 21 0 26
                                    5 26 25 0 13 137 939 305 2057 168 1118 308 2052 312 2074 5 41 5 41 -28 48
                                    -19 3 -272 42 -564 86 -1112 169 -1339 203 -1975 300 -360 55 -864 131 -1120
                                    170 -256 39 -582 88 -725 110 -143 22 -469 71 -725 110 -256 39 -760 115
                                    -1120 170 -360 55 -864 131 -1120 170 -256 39 -472 73 -482 76 -9 2 -19 1 -22
                                    -4z m864 -682 c113 -11 459 -45 770 -75 311 -30 889 -86 1285 -124 814 -80
                                    1532 -149 2220 -216 259 -25 745 -72 1080 -105 336 -33 804 -78 1040 -101 237
                                    -23 431 -42 432 -43 1 -1 -142 -432 -318 -956 -177 -525 -421 -1254 -543
                                    -1620 l-223 -665 -29 3 c-49 4 -2056 191 -2274 212 -113 11 -736 69 -1385 130
                                    -649 61 -1297 122 -1440 135 -143 14 -604 57 -1025 96 -421 39 -770 72 -777
                                    74 -9 3 -9 14 2 47 7 24 37 122 65 218 28 96 69 234 90 305 21 72 206 695 410
                                    1385 435 1472 389 1320 403 1320 7 0 104 -9 217 -20z"/>
                                    </g>
                                    </svg>

                                </div>

                                <div class="mx-5">
                                    <h4 class="text-2xl font-semibold text-gray-700">{{films.length}}</h4>
                                    <div class="text-gray-500">Films</div>
                                </div>
                            </div>
                        </div>

                        <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 xl:mt-0">
                            <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                                <div class="p-3 rounded-full bg-pink-600 bg-opacity-75">
                                    <svg class="h-8 w-8 text-white"  xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 1280.000000 1005.000000"
                                        preserveAspectRatio="xMidYMid meet">
                                        <g transform="translate(0.000000,1005.000000) scale(0.100000,-0.100000)"
                                        fill="#FFFFFF" stroke="none">
                                        <path d="M7387 10040 c-577 -56 -1110 -268 -1547 -617 -117 -94 -316 -288
                                        -417 -408 -289 -344 -516 -810 -604 -1241 -12 -60 -27 -114 -33 -120 -6 -6
                                        -78 -23 -161 -38 -82 -15 -157 -29 -166 -32 -12 -3 -35 24 -84 96 -275 414
                                        -659 725 -1122 909 -465 185 -1034 212 -1518 72 -300 -86 -574 -226 -825 -420
                                        -117 -90 -330 -306 -419 -424 -204 -273 -352 -583 -424 -892 -114 -484 -78
                                        -987 103 -1439 142 -357 383 -690 685 -946 235 -199 590 -388 868 -462 l87
                                        -23 0 -132 0 -133 -239 0 c-140 0 -241 4 -243 9 -2 6 -131 57 -287 115 l-284
                                        106 -199 0 c-109 0 -198 -2 -198 -5 0 -4 617 -1291 626 -1306 2 -3 56 8 120
                                        26 l116 31 66 107 65 107 229 0 228 0 0 -1490 0 -1490 4150 0 4150 0 0 2475 0
                                        2475 -322 0 -322 0 45 37 c410 344 741 860 893 1394 125 438 143 919 51 1375
                                        -106 523 -371 1023 -750 1413 -401 413 -875 680 -1436 810 -241 56 -645 84
                                        -882 61z m-2199 -4387 c126 -206 274 -386 471 -574 l134 -129 -742 0 c-409 0
                                        -741 3 -739 8 2 4 33 52 69 107 110 164 225 400 269 551 l12 41 147 28 c131
                                        25 314 61 318 64 0 1 28 -43 61 -96z m4196 -4678 c93 -45 146 -130 146 -235 0
                                        -76 -21 -129 -71 -178 -54 -55 -104 -76 -184 -76 -79 -1 -130 20 -185 76 -129
                                        129 -77 357 97 423 50 19 147 14 197 -10z"/>
                                        <path d="M12060 4810 l-724 -440 -573 0 -573 0 2 -1102 3 -1103 580 -5 580 -5
                                        715 -434 c393 -238 718 -435 723 -438 4 -2 7 889 7 1981 0 1092 -3 1986 -7
                                        1986 -5 -1 -334 -199 -733 -440z"/>
                                        </g>
                                    </svg>
                                </div>
                                <div class="mx-5">
                                    <h4 class="text-2xl font-semibold text-gray-700">{{webseries.length}}</h4>
                                    <div class="text-gray-500">Web Series</div>
                                </div>
                            </div>
                        </div>

                        <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 xl:mt-0">
                            <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                                <div class="p-3 rounded-full bg-pink-600 bg-opacity-75">
                                    <svg class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 1188.000000 1280.000000"
                                        preserveAspectRatio="xMidYMid meet">
                                        <g transform="translate(0.000000,1280.000000) scale(0.100000,-0.100000)"
                                        fill="#FFFFFF" stroke="none">
                                        <path d="M9472 12785 c-91 -28 -169 -108 -193 -199 -11 -40 -8 -130 6 -172 5
                                        -17 -232 -272 -1439 -1546 l-1446 -1526 -203 -1 c-310 0 -587 -33 -859 -101
                                        l-45 -12 -1509 1004 -1509 1004 0 74 c-1 90 -24 147 -87 209 -110 109 -294
                                        107 -402 -5 -87 -90 -107 -220 -51 -330 70 -136 235 -193 374 -129 l54 25
                                        1444 -962 1444 -961 -98 -39 c-469 -184 -819 -467 -985 -798 l-38 -75 2277 -3
                                        c1252 -1 2278 0 2280 2 3 2 -11 35 -29 73 -182 370 -606 684 -1163 863 -173
                                        55 -419 111 -558 126 -34 4 -67 9 -74 13 -7 3 548 597 1372 1466 1158 1222
                                        1387 1460 1407 1457 12 -2 58 -6 100 -9 67 -4 83 -2 130 19 103 48 158 129
                                        166 246 4 66 2 78 -27 137 -65 131 -203 193 -339 150z"/>
                                        <path d="M115 8151 c-48 -22 -79 -54 -100 -103 -13 -34 -15 -424 -15 -3771 l0
                                        -3733 25 -50 c26 -52 70 -88 126 -104 19 -6 198 -10 415 -10 l381 0 7 -57 c3
                                        -32 8 -101 11 -153 4 -52 8 -105 11 -117 l4 -23 244 0 243 0 6 68 c4 37 9 115
                                        13 175 l7 107 4387 0 4387 0 12 -177 c7 -98 14 -184 16 -191 3 -9 62 -12 248
                                        -12 l244 0 12 178 c7 97 14 183 16 190 4 9 101 12 442 12 254 0 452 4 472 10
                                        56 16 100 52 126 104 l25 50 0 3735 c0 3611 -1 3737 -19 3776 -22 48 -54 79
                                        -103 100 -34 13 -623 15 -5820 15 -5601 0 -5784 -1 -5823 -19z"/>
                                        </g>
                                    </svg>
                                </div>

                                <div class="mx-5">
                                    <h4 class="text-2xl font-semibold text-gray-700">{{novelas.length}}</h4>
                                    <div class="text-gray-500">Novelas</div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

            
            <div class="mt-8"></div> 
            <div class="flex flex-col mt-8">
                <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                    <div
                        class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                        <table class="min-w-full">
                            <thead>
                                <tr>
                                    <th
                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    id</th>
                                    <th
                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    avatar</th>
                                    <th
                                        class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Name</th>
                                    <th
                                        class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Email</th>
                                    <th
                                        class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Role</th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                                </tr>
                            </thead>

                            <!--Partie user-->
                            <tbody class="bg-white">
                                <tr v-for="user in users" :key="user.id">
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            <div class="text-sm leading-5 text-gray-900">{{user.id}}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full bg-black"
                                                        src="/logos/logoblanc.png"
                                                        alt="">
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            <div class="text-sm leading-5 text-gray-900">{{user.name}}</div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">{{user.email}}</span>
                                        </td>

                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-400 text-white" v-if="user.type == 0">utilisateur</span>
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-400 text-white" v-if="user.type == 1">createur</span>
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-400 text-white" v-if="user.type == 2">admin</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap text-right border-b space-x-2 border-gray-200 text-sm leading-5 font-medium flex">
                                                <a @click="hidden = true; param.idEdit = user.id"  class="bg-blue-500 py-3 px-8 rounded-xl text-white hover:text-blue-500 hover:bg-transparent border-2 border-blue-500">Edit</a>
                                                <form >
                                                    <button  class="bg-red-500 py-3 px-3 rounded-xl text-white hover:text-red-500 border-2 hover:bg-transparent border-red-500" @click="deleteUser(user.id)">Supprimer</button>
                                                </form>
                                        </td>
                                </tr>  
                            </tbody>
                        </table>
                    </div>
                </div>   
            </div>
        </div>
    </main>
    </div>
  </div>
</template>

<script>
export default {
data(){
        return{
            loading: 'true',
            editLoading: '',
            films: {},
            series: {},
            novelas: {},
            name: '',
            webseries: {},
            users: {},
            param: {
                idEdit: '',
                statut: '',
            },
            errors: '',
            hidden: false,
        }
    },

    mounted(){
        axios.get('/api/statistique').then(({data})=>{
                this.films = data[0]
                this.series = data[1]
                this.users = data[2]
                this.webseries = data[3]
                this.novelas = data[4]
                this.loading = false
                
                console.log(this.data)
        }).catch(error=> console.log(error))
    },

    methods:{
        deleteUser(id){
            axios.delete('/api/deleteuser/' + id)
                .then(response => this.users = response.data)   
                .catch(error=> console.log(error))
        },
        editUser(id){
            axios.put('/api/edituser/' ,this.param)
                .then(response => {
                    this.users = response.data
                    this.editLoading = 'oui'
                    })
                .catch(error=> console.log(error))
        },

        pageLogin(){
            this.$router.push('/');
            this.$router.go();
        },

        search(){
            if(this.name.length > 0){
                axios.get('/api/searchusers/'+ this.name).then(({data})=>{
                        this.users = data
                }).catch(error=> console.log(error)) 
            }else{
                axios.get('/api/searchusers/'+ this.name).then(({data})=>{
                        this.users = data
                }).catch(error=> console.log(error)) 
            }
        },
    }
}
</script>

<style>

</style>