<template>

<div v-if="inscrito" class="container col-sm-6 py-2">
    <div class="">
        <div class="card">
          <img width="50" height="100" :src="curso.archivo.ruta" class="card-img-top" alt="...">
        <div class="card-body">
        <h5 class="card-title"></h5>
        <input type="hidden" :value="user.id">
          <p class="card-text">{{curso.nombre}}</p>
          <p class="card-text">{{curso.description}}</p>
          <p class="card-text">Profesor: {{curso.profesor.name}}</p>
          <a :href="`/vistageneral/${curso.id}`" class="btn btn-success">Entrar al curso</a>
        </div>
      </div>
    </div>
</div>

</template>

<script>

export default {
        props: ['curso'],
        data() {
            return {
                prop: {id: '', nombre: '', description: '', password: ''},
                modoEdicion: false,
                password: '',
                mios: null,
                id: '',
                inscrito: false
            }
        },

         mounted() {
            var tamano = '';
            var usuarioID = '';
            usuarioID = this.user.id;
            tamano = this.curso.users.length;
            for (let i = 0; i < tamano; i++) {
                if (usuarioID === this.curso.users[i].id) {
                    this.inscrito = true;
                }else{
                    this.inscrito = false;
                }
                
            }  
        },

        methods: {
    }
}

</script>