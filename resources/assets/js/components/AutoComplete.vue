<template>
    <div class="col-md-6">
        <input type="text" placeholder="what are you looking for?" v-model="query" v-on:keyup="autoComplete" class="form-control">
        <div class="panel-footer" v-if="results.length" style="position: absolute;z-index: 2;">
            <ul class="list-group" style="height: 300px; overflow: auto">
                <a :href="url+result.id" v-for="result in results" v-key="result.id">
                    <li class="list-group-item">
                    {{ result.address }}
                    </li>
                </a>
            </ul>
        </div>
        <div class="panel-footer" v-if="results.length == 0 && query.length > 2" style="position: absolute;z-index: 2;">
            <ul class="list-group" style="height: 300px; overflow: auto">
                <li class="list-group-item"> No property available</li>
            </ul>
        </div>
    </div>
</template>
<script>
    export default{
        data(){
            return {
                query: '',
                results: [],
                url: '/home?id='
            }
        },
        methods: {
            autoComplete(){
                this.results = [];
                if(this.query.length > 2){
                    axios.post('/api/sales/search',{q: this.query}).then(response => {
                    this.results = response.data;
                    });
                }
            }
        },
        created() {
            console.log("nice");
        }
    }
</script>