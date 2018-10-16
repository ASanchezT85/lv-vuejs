<template>
    <div>
        <h1 class="text-center display-4">
            <i class="far fa-lightbulb mr-2 text-warning"></i>
            Captura tus ideas
        </h1>
        <div class="jumbotron">
            <form v-on:submit.prevent="createIdea" accept-charset="utf-8">
                <div class="input-group mb-3">
                    <input type="text" class="form-control input-sm" 
                           maxlength="256" placeholder="¿En que estas pensando?" aria-label="¿En que estas pensando?" 
                           aria-describedby="idea"
                           v-model="newIdea">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="submit" 
                                id="idea">
                            Agregar
                        </button>
                    </div>
                </div>
            </form>
            <hr>
            <ul class="list-unstyled">
                <li v-for="idea in ideas">
                    <p>
                        <i class="far fa-lightbulb mr-2 text-warning"></i> {{ idea.description }}
                        <small class="text-muted">
                            <em class="mr-2"> - {{ since(idea.created_at) }}</em>
                        </small>
                        <a href="#" title="Eliminar" class="text-danger mr-2" v-on:click.prevent="deleteIdea(idea)"><i class="fas fa-times"></i></a>
                    </p>
                </li>
            </ul>
        </div>
        <hr>
        <p class="text-center">
            Sigueme
        </p>
        <p class="text-center redsocial">
            <a href="https://github.com/ASanchezT85/lv-vuejs.git" title="Github">
                <i class="fab fa-github-square"></i>
            </a>
            <a href="https://twitter.com/sira8s" title="Twitter">
                <i class="fab fa-twitter-square"></i>
            </a>
            <a href="https://www.facebook.com/ajstalito" title="Facebook">
                <i class="fab fa-facebook-square"></i>
            </a>
            <a href="live:ajstalito" title="Skype">
                <i class="fab fa-skype"></i>
            </a>
        </p>
        <hr>
    </div>
</template>

<script>
    import axios from 'axios'
    import toastr from 'toastr'
    import moment from 'moment'

    moment.locale('es');

    export default {
        data () {
            return {
                ideas: [],
                newIdea: '',
            }
        },
        created: function(){
            this.getIdeas();
        },
        methods: {
            since: function(d){
                return moment(d).fromNow();
            },
            getIdeas: function () {
                var urlIdeas = 'mis-ideas';
                axios.get(urlIdeas).then(response => {
                    this.ideas = response.data
                });
            },
            createIdea: function(){
                var url = 'guardar-ideas';
                axios.post(url, {
                    description: this.newIdea
                }).then(response => {
                    this.getIdeas();
                    this.newIdea = '';
                    toastr.success('Nueva idea registrada con éxito');
                }).catch(error => {
                    toastr.error('Error');
                });
            },
            deleteIdea: function(idea){
                var url = 'eliminar/' + idea.id;
                axios.delete(url).then(response => {
                    this.getIdeas();
                    toastr.success('Eliminado correctamente');
                }).catch(error => {
                    toastr.error('Error');
                });
            }
        }
    }
</script>

<<style>
    .redsocial{
        font-size: 2rem;
    }
</style>