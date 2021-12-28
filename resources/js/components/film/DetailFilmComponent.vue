<template>
  <div>
  <!--Partie acteurs-->
    <transition name="slide-fade">
        <div v-show="hidacteur" class=" fixed flex items-center" style=" z-index:5; width: 100%; height: 80%">
            <div class="w-full h-screen mx-auto relative">
            <div class="bg-white backdrop-filter backdrop-blur-lg opacity-75 w-full h-full absolute"></div>
            <div class="w-full h-full relative  mx-auto" style=" z-index: 5;">
                <div class=" w-4/5 h-full flex items-center">
                    <div class="md:w-2/5 w-4/5 mt-3 mx-auto " style=" z-index: 5;">
                    <div class=" w-full h-auto pb-2 mt-16 items-center bg-white shadow-2xl rounded-xl" style=" z-index: 5;">
                        <!--header-->
                        <div class="w-full font-bold text-xl flex">
                            <p class="mx-auto text-white"></p>
                            <button @click="hidacteur = false"  class="bg-blue-500 flex items-center text-white h-8 w-8 rounded-full transform -translate-y-6 translate-x-4">
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
                                            <div v-if="acteurloading == 'non'" class="flex w-full h-auto" >
                                                <div  class=" flex justify-center items-center mx-auto">
                                                    <div class="animate-spin rounded-full h-20 w-20 border-t-2 border-b-2 border-blue-500"></div>
                                                </div>
                                            </div>
                                            <svg v-if="acteurloading == 'oui'" class="w-20 h-20 mx-auto mb-4 rounded-full border-blue-500 border-2" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                    viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
                                                <circle style="fill:#fff;" cx="25" cy="25" r="25"/>
                                                <polyline style="fill:none;stroke:#5962DF;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;" points="
                                                    38,15 22,33 12,25 "/>
                                            </svg>
                                        </div>
                                        <p class=" text-center text-sm text-gray-500">Voulez allez Ajouter un acteur</p>
                                        <form @submit.prevent="addActeur" class=" space-y-6">
                                            <div class="w-full h-full mt-4 space-y-3">
                                                <div>
                                                    <input v-model="formActeur.nom" class="border-2 bg-transparent appearance-none  focus:outline-none text-gray-600 px-2 min-w-full py-2 " placeholder="titre">
                                                </div>
                                                <div class=" w-full h-20 space-y-3">
                                                    <div class="flex w-full">
                                                        <div class=" w-1/2 ">
                                                            <label class=" ">Photo</label>
                                                        </div>
                                                        <div class=" w-1/2 relative">
                                                            <button class="  bg-red-500 text-white rounded-xl absolute right-2 px-3" v-if="this.formActeur.photo"  @click="removeActeur">effacer</button>
                                                        </div>
                                                    </div>
                                                    <input @change="onActeurFile" type="file" class=" mt-2 border-2 bg-transparent appearance-none  focus:outline-none text-gray-600 px-2 w-full py-2 ">
                                                </div>
                                            </div>
                                            <div class=" w-full flex">
                                                <button @click="acteurloading = 'non'" class=" bg-blue-500 px-4 py-3 text-white hover:bg-blue-300 mx-auto rounded-lg">Enregistrer</button>
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

  <!--Partie genre-->
    <transition name="slide-fade">
        <div v-show="hidgenre" class=" fixed flex items-center" style=" z-index:5; width: 100%; height: 80%">
            <div class="w-full h-screen mx-auto relative">
            <div class="bg-white backdrop-filter backdrop-blur-lg opacity-75 w-full h-full absolute"></div>
            <div class="w-full h-full relative  mx-auto" style=" z-index: 5;">
                <div class=" w-4/5 h-full flex items-center">
                    <div class="md:w-2/5 w-4/5 mt-3 mx-auto " style=" z-index: 5;">
                    <div class=" w-full h-auto pb-2 mt-16 items-center bg-white shadow-2xl rounded-xl" style=" z-index: 5;">
                        <!--header-->
                        <div class="w-full font-bold text-xl flex">
                            <p class="mx-auto text-white"></p>
                            <button @click="hidgenre = false"  class="bg-blue-500 flex items-center text-white h-8 w-8 rounded-full transform -translate-y-6 translate-x-4">
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
                                            <div v-if="genreloading == 'non'" class="flex w-full h-auto" >
                                                <div  class=" flex justify-center items-center mx-auto">
                                                    <div class="animate-spin rounded-full h-20 w-20 border-t-2 border-b-2 border-blue-500"></div>
                                                </div>
                                            </div>
                                            <svg v-if="genreloading == 'oui'" class="w-20 h-20 mx-auto mb-4 rounded-full border-blue-500 border-2" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                    viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
                                                <circle style="fill:#fff;" cx="25" cy="25" r="25"/>
                                                <polyline style="fill:none;stroke:#5962DF;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;" points="
                                                    38,15 22,33 12,25 "/>
                                            </svg>
                                        </div>
                                        <p class=" text-center text-sm text-gray-500">Voulez allez Ajouter un genre</p>
                                        <form class=" space-y-6">
                                            <div class="w-full h-full mt-4">
                                                <select  v-model="formGenre.nom" class="border w-full h-full bg-white text-black py-2 px-3 text-grey-800">
                                                    <option  value="">Choisissez un genre</option>
                                                    <option>Action</option>
                                                    <option>Aventure</option>
                                                    <option>Comique</option>
                                                    <option>Drame</option>
                                                    <option>Horreur</option>
                                                    <option>Documentaire</option>
                                                    <option>Fantastique</option>
                                                </select>
                                            </div>
                                            <div class=" w-full flex">
                                                <button @click="addGenre(); genreloading = 'non'" class=" bg-blue-500 px-4 py-3 text-white hover:bg-blue-300 mx-auto rounded-lg">Enregistrer</button>
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
        <!--Bar search-->
      <div class=" h-16 bg-gray-900 shadow-2xl flex fixed px-2" style=" width: 80%;">
           <div class=" w-1/4 h-full flex items-center">
                <router-link to="/films"><img  class="w-8 h-8 ml-4" src="images/return.png" alt=""></router-link>
           </div>        
          <div class=" w-2/4 h-full flex items-center">
              <p class=" mx-auto text-white text-3xl font-semibold">{{ detailFilm.titre }}</p>
          </div>
          <div class=" w-1/4 h-full flex items-center">
              <div class="h-10 mx-auto space-x-3 flex">
                    <img @click="hidacteur = true"  class="w-10 h-10 ml-4" src="images/acteur.png" alt="">
                    <img @click="hidgenre = true"  class="w-10 h-10 ml-4" src="images/genre.png" alt="">
                    <img @click="ActivePubFilm()"  class="w-10 h-10 ml-4" v-if="detailFilm.banniere == true" src="images/on.png" alt="">
                    <img @click="ActivePubFilm()"  class="w-10 h-10 ml-4" v-if="detailFilm.banniere == false" src="images/off.png" alt="">
              </div>
          </div>
      </div>

    <!--Tout les films-->
        <div class=" w-full">
            <div class=" w-full h-16"></div>
            <div class=" w-full  flex overflow-hidden" style=" height: 35rem;">
                <div class=" w-1/2 h-full ">

                    <!--Detail film-->
                    <div class=" w-full h-1/3 ">
                        <div  @click="affiche = true" class=" w-36 h-44 ml-2 mt-2 space-y-8" v-if="detailFilm.video && affiche == false">
                                <div class=" w-full h-1/2 flex">
                                    <img class=" w-28 h-28 mx-auto" :src="'/images/' + detailFilm.image">
                                </div>
                                <div class=" w-full h-1/2 flex">
                                    <div class="w-28 h-28 mx-auto">
                                        <p class=" font-semibold text-center text-sm">{{ detailFilm.titre }}</p>
                                    </div>
                                </div>
                        </div>
                        <div  @click="affiche = false" class=" w-36 h-44 ml-2 mt-2 space-y-8" v-if="detailFilm.video && affiche == true">
                                <div class=" w-full h-1/2 flex">
                                    <img class=" w-28 h-28 mx-auto" :src="'/images/' + detailFilm.image">
                                </div>
                                <div class=" w-full h-1/2 flex">
                                    <div class="w-28 h-28 mx-auto">
                                        <p class=" font-semibold text-center text-sm">{{ detailFilm.titre }}</p>
                                    </div>
                                </div>
                        </div>
                    </div>

                    <!--Deatail acteur-->
                    
                    <div class=" w-full h-2/3" v-if="this.affiche">
                        <div class=" px-2 w-full text-xl">
                            <p>Liste des acteurs du film {{ detailFilm.titre }}</p>
                        </div>
                        <div class=" w-full  flex-wrap flex overflow-hidden overflow-y-visible " v-if="acteursFilm" style=" height: 25rem;">
                            <div class=" w-36 h-36 ml-4 mt-4 space-y-4 bg-gray-300 shadow-2xl"  v-for="acteurFilm in acteursFilm" :key="acteurFilm.id">
                                <div class=" w-full h-2/3 flex overflow-hidden relative">
                                    <img class=" w-full h-28 mx-auto object-cover object-center" :src="'/acteurs/' + acteurFilm.photo">
                                    <button @click="deleteActeurFilm(acteurFilm.id)"  class="bg-red-500 flex items-center text-white h-8 w-8 rounded-full  absolute right-1 top-1">
                                        <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                    </button>
                                </div>
                                <div class=" w-full h-1/3 flex">
                                    <div class="w-28 h-28 mx-auto">
                                        <p class=" font-semibold text-center text-sm">{{ acteurFilm.nom }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Deatail Genre et informations du film-->

                <div class=" w-1/2 h-full" v-if="this.affiche">
                    <div class=" w-full" >
                        <p class=" text-2xl font-semibold ml-2 mt-2">Genres</p>
                    </div>
                    <div class=" space-x-3 flex ml-2 mt-3" v-if="genresFilm">
                        <div class=" px-3 py-1 rounded-xl bg-gray-500 flex items-center space-x-2" v-for="genreFilm in genresFilm" :key="genreFilm.id">
                            <p class=" text-sm text-white">{{ genreFilm.nom }}</p>
                            <img @click="deleteGenreFilm(genreFilm.id)" class=" w-3 h-3" src="images/close.png" alt="">
                        </div>
                    </div>
                    <div class=" w-full mt-6">
                        <p class=" text-2xl font-semibold ml-2 mt-2">Informations du film</p>
                    </div>
                    <div class=" w-full mt-3 ml-2">
                        <div>
                            <p class=" font-semibold">Duree: {{detailFilm.duree}}</p>
                        </div>
                    </div>
                    <div class=" w-full mt-3 ml-2">
                        <div>
                            <p class=" font-semibold">date de sortie: {{detailFilm.date_de_sortie}}</p>
                        </div>
                    </div>
                    <div class=" w-full mt-3 ml-2">
                        <div>
                            <p class=" font-semibold">qualite: {{detailFilm.qualite}}</p>
                        </div>
                    </div>
                    <div class=" w-full mt-3 ml-2">
                        <div>
                            <p class=" font-semibold text-justify">description: {{detailFilm.description}}</p>
                        </div>
                    </div>
                    <div class=" w-full mt-3 ml-2">
                        <div>
                            <p class=" font-semibold">age: {{detailFilm.age}}</p>
                        </div>
                    </div>
                    <div class=" w-full mt-3 ml-2">
                        <div>
                            <p class=" font-semibold">banniere: {{detailFilm.banniere}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </div>
</template>

<script>
export default {

    props:['film'],
    data(){
        return{
          detailFilm: {},
          hidgenre: false,
          hidacteur: false,
          affiche: false,
          genreloading: '',
          acteurloading: '',
          acteursFilm: {},
          genresFilm: {},
          formGenre : {
              nom: '',
              id: this.film,
          },
          formActeur : {
              nom: '',
              id: this.film,
              photo: null,
          },
          id: this.film,
        }
    },
     mounted(){
        axios.get('/api/detailpage/' + this.id).then(({data})=>{
                this.detailFilm = data[0][0]
                this.acteursFilm = data[1]
                this.genresFilm= data[2]
                this.loading = false
                console.log(data)
        }).catch(error=> console.log(error))
    },
    methods:{

        /*-Methodes acteur films-*/

        addGenre(){
            axios.post('/api/savegenrefilm/', this.formGenre).then(({data})=>{
                this.genresFilm = data
                this.loadgenre = false
                this.genreloading = 'oui'
                console.log(data)
            }).catch(error=> console.log(error))
        },
        deleteGenreFilm(id){
            axios.delete('/api/deletegenrefilm/' + id).then(({data})=>{
                this.genresFilm = data
                console.log(data)
            }).catch(error=> console.log(error))
        },

        /*-Methodes acteur films-*/
        onActeurFile(photo) {
            console.log("photo acteur", photo.target.files[0])
            this.formActeur.photo = photo.target.files[0]
        },

        addActeur(){
            let acteur = new FormData();
            acteur.append('nom', this.formActeur.nom);
            acteur.append('id', this.formActeur.id);
            acteur.append('photo', this.formActeur.photo);
            axios.post('/api/saveacteurfilm/', acteur).then(({data})=>{
                this.acteursFilm = data
                this.loadacteur = false
                this.acteurloading = 'oui'
                console.log(data)
            }).catch(error=> console.log(error))
        },
        deleteActeurFilm(id){
            axios.delete('/api/deleteacteurfilm/' + id).then(({data})=>{
                this.acteursFilm = data
                console.log(data)
            }).catch(error=> console.log(error))
        },
        removeActeur: function (e) {
            this.formActeur.photo = '';
        },
        ActivePubFilm(){
            axios.put('/api/activepublicite/' + this.id).then(({data})=>{
                this.detailFilm = data
                console.log(data)
            }).catch(error=> console.log(error))
        },
    }
}
</script>

<style>

</style>