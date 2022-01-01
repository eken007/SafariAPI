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
                                                    <input v-model="formActeur.nom" class="border-2 bg-transparent appearance-none  focus:outline-none text-gray-600 px-2 min-w-full py-2 " placeholder="nom de l'acteur">
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
                                        <form @submit.prevent="addGenre" class=" space-y-6">
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
                                                <button @click="genreloading = 'non'" class=" bg-blue-500 px-4 py-3 text-white hover:bg-blue-300 mx-auto rounded-lg">Enregistrer</button>
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

    <!--Partie saison-->
    <transition name="slide-fade">
        <div v-show="hidsaison" class=" fixed flex items-center" style=" z-index:5; width: 100%; height: 80%">
            <div class="w-full h-screen mx-auto relative">
            <div class="bg-white backdrop-filter backdrop-blur-lg opacity-75 w-full h-full absolute"></div>
            <div class="w-full h-full relative  mx-auto" style=" z-index: 5;">
                <div class=" w-4/5 h-full flex items-center">
                    <div class="md:w-2/5 w-4/5 mt-3 mx-auto " style=" z-index: 5;">
                    <div class=" w-full h-auto pb-2 mt-16 items-center bg-white shadow-2xl rounded-xl" style=" z-index: 5;">
                        <!--header-->
                        <div class="w-full font-bold text-xl flex">
                            <p class="mx-auto text-white"></p>
                            <button @click="hidsaison = false"  class="bg-blue-500 flex items-center text-white h-8 w-8 rounded-full transform -translate-y-6 translate-x-4">
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
                                            <div v-if="saisonloading == 'non' && this.errors == ''" class="flex w-full h-auto" >
                                                <div  class=" flex justify-center items-center mx-auto">
                                                    <div class="animate-spin rounded-full h-20 w-20 border-t-2 border-b-2 border-blue-500"></div>
                                                </div>
                                            </div>
                                            <div v-if="this.errors == 'Saison exist'" class="flex w-full h-auto" >
                                                <div  class=" flex justify-center items-center mx-auto">
                                                    <p class=" text-red-500">cette saison existe</p>
                                                </div>
                                            </div>
                                            <svg v-if="saisonloading == 'oui'" class="w-20 h-20 mx-auto mb-4 rounded-full border-blue-500 border-2" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                    viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
                                                <circle style="fill:#fff;" cx="25" cy="25" r="25"/>
                                                <polyline style="fill:none;stroke:#5962DF;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;" points="
                                                    38,15 22,33 12,25 "/>
                                            </svg>
                                        </div>
                                        <p class=" text-center text-sm text-gray-500">Vous allez Ajouter une saison</p>
                                        <form @submit.prevent="addSaison" class=" space-y-6">
                                            <div class="w-full h-full mt-4">
                                                <select  v-model="formSaison.nom"  class="border w-full h-full bg-white text-black py-2 px-3 text-grey-800">
                                                    <option  value="">Choisissez une saison</option>
                                                    <option v-for="saison in 100" :key="saison">Saison {{saison}}</option>
                                                </select>
                                            </div>
                                            <div class=" w-full flex">
                                                <button @click="saisonloading = 'non'" class=" bg-blue-500 px-4 py-3 text-white hover:bg-blue-300 mx-auto rounded-lg">Enregistrer</button>
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
                <router-link to="/Series"><img  class="w-8 h-8 ml-4" src="/images/return.png" alt=""></router-link>
           </div>        
          <div class=" w-2/4 h-full flex items-center">
              <p class=" mx-auto text-white text-3xl font-semibold">{{ detailSerie.titre }}</p>
          </div>
          <div class=" w-1/4 h-full flex items-center">
              <div class="h-10 mx-auto space-x-3 flex">
                    <button>
                        <div class=" w-10 h-10 rounded-full bg-blue-500 flex items-center">
                            <p @click="hidsaison = true" class="mx-auto mb-2 text-white text-4xl">+</p>
                        </div>
                    </button>
                    <img @click="hidacteur = true"  class="w-10 h-10 ml-4" src="/images/acteur.png" alt="">
                    <img @click="hidgenre = true"  class="w-10 h-10 ml-4" src="/images/genre.png" alt="">
                    <img @click="ActivePubSerie()"  class="w-10 h-10 ml-4" v-if="detailSerie.banniere == true" src="/images/on.png" alt="">
                    <img @click="ActivePubSerie()"  class="w-10 h-10 ml-4" v-if="detailSerie.banniere == false" src="/images/off.png" alt="">
              </div>
          </div>
      </div>

    <!--Tout les Series-->
        <div class=" w-full">
            <div class=" w-full h-16"></div>
            <div class=" w-full  flex overflow-hidden" style=" height: 35rem;">
                <div class=" w-1/2 h-full ">

                    <!--Detail Serie-->
                    <div class=" w-full h-1/2 flex flex-wrap overflow-hidden overflow-y-visible">
                        <div class=" w-36 h-44 ml-6 mt-6 space-y-4 relative" v-for="saisonSerie in saisonsSerie" :key="saisonSerie.id">
                            <button @click="deleteSaison(saisonSerie.id)"  class="bg-red-500 flex items-center text-white h-8 w-8 rounded-full  absolute right-1 top-8">
                                <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                            <router-link :to="{name:'detailsaison', params:{saison: saisonSerie.id} }" class=" w-36 h-44 ml-6 mt-6 space-y-4">
                                <div class=" w-full h-1/2 flex">
                                    <img class=" w-28 h-28 mx-auto" src="/images/folder.png">
                                </div>
                                <div class=" w-full h-1/2 flex">
                                    <div class="w-28 h-28 mx-auto">
                                        <p class=" font-semibold text-center text-sm">{{saisonSerie.nom}}</p>
                                    </div>
                                </div>
                            </router-link>
                        </div>
                    </div>

                    <!--Deatail acteur-->
                    
                    <div class=" w-full h-1/2">
                        <div class=" px-2 w-full text-xl">
                            <p>Liste des acteurs de la serie {{ detailSerie.titre }}</p>
                        </div>
                        <div class=" w-full  flex-wrap flex overflow-hidden overflow-y-visible " v-if="acteursSerie" style=" height: 25rem;">
                            <div class=" w-36 h-36 ml-4 mt-4 space-y-4 bg-gray-300 shadow-2xl"  v-for="acteurSerie in acteursSerie" :key="acteurSerie.id">
                                <div class=" w-full h-2/3 flex overflow-hidden relative">
                                    <img class=" w-full h-28 mx-auto object-cover object-center" :src="'/acteurs/' + acteurSerie.photo">
                                    <button @click="deleteActeurSerie(acteurSerie.id)"  class="bg-red-500 flex items-center text-white h-8 w-8 rounded-full  absolute right-1 top-1">
                                        <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                    </button>
                                </div>
                                <div class=" w-full h-1/3 flex">
                                    <div class="w-28 h-28 mx-auto">
                                        <p class=" font-semibold text-center text-sm">{{ acteurSerie.nom }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Deatail Genre et informations du Serie-->

                <div class=" w-1/2 h-full">
                    <div class=" w-full" >
                        <p class=" text-2xl font-semibold ml-2 mt-2">Genres</p>
                    </div>
                    <div class=" space-x-3 flex ml-2 mt-3" v-if="genresSerie">
                        <div class=" px-3 py-1 rounded-xl bg-gray-500 flex items-center space-x-2" v-for="genreSerie in genresSerie" :key="genreSerie.id">
                            <p class=" text-sm text-white">{{ genreSerie.nom }}</p>
                            <img @click="deleteGenreSerie(genreSerie.id)" class=" w-3 h-3" src="/images/close.png" alt="">
                        </div>
                    </div>
                    <div class=" w-full mt-6">
                        <p class=" text-2xl font-semibold ml-2 mt-2">Informations du Serie</p>
                    </div>
                    <div class=" w-full mt-3 ml-2" v-if="detailSerie.duree">
                        <div>
                            <p class=" font-semibold">Duree: {{detailSerie.duree}}</p>
                        </div>
                    </div>
                    <div class=" w-full mt-3 ml-2">
                        <div>
                            <p class=" font-semibold">date de sortie: {{detailSerie.date_de_sortie}}</p>
                        </div>
                    </div>
                    <div class=" w-full mt-3 ml-2" v-if="detailSerie.qualite">
                        <div>
                            <p class=" font-semibold">qualite: {{detailSerie.qualite}}</p>
                        </div>
                    </div>
                    <div class=" w-full mt-3 ml-2">
                        <div>
                            <p class=" font-semibold text-justify">description: {{detailSerie.description}}</p>
                        </div>
                    </div>
                    <div class=" w-full mt-3 ml-2">
                        <div>
                            <p class=" font-semibold">age: {{detailSerie.age}}</p>
                        </div>
                    </div>
                    <div class=" w-full mt-3 ml-2">
                        <div>
                            <p class=" font-semibold">banniere: {{detailSerie.banniere}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </div>
</template>

<script>
export default {

    props:['serie'],
    data(){
        return{
          detailSerie: {},
          hidgenre: false,
          hidacteur: false,
          hidsaison: false,
          affiche: false,
          genreloading: '',
          saisonloading: '',
          acteurloading: '',
          acteursSerie: {},
          genresSerie: {},
          saisonsSerie: {},
          formGenre : {
              nom: '',
              id: this.serie,
          },
          formSaison : {
              nom: '',
              id: this.serie,
          },
          formActeur : {
              nom: '',
              id: this.serie,
              photo: null,
          },
          id: this.serie,
          errors: ''
        }
    },
     mounted(){
        axios.get('/api/detailpage/' + this.id).then(({data})=>{
                this.detailSerie = data[0][0]
                this.acteursSerie = data[1]
                this.genresSerie= data[2]
                this.saisonsSerie = data[3]
                this.loading = false
                console.log(data)
        }).catch(error=> console.log(error))
    },
    methods:{

        /*-Methodes acteur Series-*/

        addGenre(){
            axios.post('/api/savegenreserie/', this.formGenre).then(({data})=>{
                this.genresSerie = data
                this.loadgenre = false
                this.genreloading = 'oui'
                console.log(data)
            }).catch(error=> console.log(error))
        },
        deleteGenreSerie(id){
            axios.delete('/api/deletegenreserie/' + id).then(({data})=>{
                this.genresSerie = data
                console.log(data)
            }).catch(error=> console.log(error))
        },

        /*-Methodes acteur Series-*/
        onActeurFile(photo) {
            console.log("photo acteur", photo.target.files[0])
            this.formActeur.photo = photo.target.files[0]
        },

        addActeur(){
            let acteur = new FormData();
            acteur.append('nom', this.formActeur.nom);
            acteur.append('id', this.formActeur.id);
            acteur.append('photo', this.formActeur.photo);
            axios.post('/api/saveacteurserie', acteur).then(({data})=>{
                this.acteursSerie = data
                this.loadacteur = false
                this.acteurloading = 'oui'
                console.log(data)
            }).catch(error=> console.log(error))
        },
        deleteActeurSerie(id){
            axios.delete('/api/deleteacteurserie/' + id).then(({data})=>{
                this.acteursSerie = data
                console.log(data)
            }).catch(error=> console.log(error))
        },
        removeActeur: function (e) {
            this.formActeur.photo = '';
        },
        ActivePubSerie(){
            axios.put('/api/activepublicite/' + this.id).then(({data})=>{
                this.detailSerie = data
                console.log(data)
            }).catch(error=> console.log(error))
        },

        deleteSaison(id){
            axios.delete('/api/deletesaisonserie/' + id).then(({data})=>{
                this.saisonsSerie = data
                console.log(data)
            }).catch(error=> console.log(error))
        },
        addSaison(){
            axios.post('/api/savesaisonserie', this.formSaison).then(({data})=>{
                this.saisonsSerie = data
                this.errors = ''
                this.saisonloading = 'oui'
                console.log(data)
            }).catch(error=> this.errors= error.response.data.message)
        },
    }
}
</script>

<style>

</style>