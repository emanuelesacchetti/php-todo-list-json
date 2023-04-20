
const { createApp } = Vue

createApp({
    data() {
        return {
            serverList: []
        }
    },
    methods: {  
        //faccio una chiamata axios al mio server e metto i dati dentro serverList            
        callAxios(){
                axios.get('server.php')
                .then(response => {
                    this.serverList = response.data;
                    console.log('ciao');
                })
        }
    },
    mounted() {
        this.callAxios();
    }
}).mount('#app')