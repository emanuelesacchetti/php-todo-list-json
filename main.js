
const { createApp } = Vue

createApp({
    data() {
        return {
            serverList: [],
            newTodoItem: ''
        }
    },
    methods: {  
        //faccio una chiamata axios al mio server e metto i dati dentro serverList            
        callAxios(){
            axios.get('server.php')
            .then(response => {
                this.serverList = response.data;
            })
        },
        //chiamata a axios e gli passo il valore di newTodoItem (quindi del v-model dell'input)
        addNewTask(){
            const data = {
                newTodoItem : this.newTodoItem
            };
            axios.post('server.php', data, 
            {
                headers: {'Content-Type' : 'multipart/form-data'}
            }).then(response => {
                //ricevo indietro l'array del server col il nuovo valore aggiunto e lo metto nel serverList
                this.serverList = response.data;
                this.newTodoItem = '';
            });
        },
        cambiaDone(indice){
            const data = {
                i : indice
            };
            axios.post('server.php', data, {
                headers: {'Content-Type' : 'multipart/form-data'}
            }).then(response => {
                this.serverList = response.data;
 
            });
        },
        eliminaTask(indice){
            const data = {
                index : indice
            };
            axios.post('server.php', data, {
                headers: {'Content-Type' : 'multipart/form-data'}
            }).then(response => { 
                console.log(response.data);

                this.serverList = response.data;
 
            });
        }
    },
    mounted() {
        this.callAxios();
    }
}).mount('#app')