<template>

<div class="col-sm-6 py-2">
      <div class="card">
          <img width="50" height="100" :src="curso.archivo.ruta" class="card-img-top" alt="...">
        <div v-if="inscrito">
        <div class="card-body">
        <h5 class="card-title">{{curso.nombre}}</h5>
        <input type="hidden" :value="user.id">
          <p class="card-text">{{curso.description}}</p>
          <p class="card-text">Profesor: {{curso.profesor.name}}</p>
          <a :href="`/vistageneral/${curso.id}`" class="btn btn-success">Entrar al curso</a>
        </div>
        </div>
        <div v-else>
            <div v-if="modoEdicion" class="card-body">
            <h5 class="card-title">{{curso.nombre}}</h5>
            <p class="card-text">{{curso.description}}</p>
            <p class="card-text">Profesor:  {{curso.profesor.name}}</p>
            <input type="hidden" :value="curso.id">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" v-model="password">
                <br>
                <button class="btn btn-primary" @click="inscribir">Inscribir curso</button>
                <button class="btn btn-danger" @click="cancelar">Cancelar</button>
        </div>
        <div v-else class="card-body">
        <h5 class="card-title">{{curso.nombre}}</h5>
        <input type="hidden" :value="user.id">
          <p class="card-text">{{curso.description}}</p>
          <p class="card-text">Profesor: {{curso.profesor.name}}</p>
          <button class="btn btn-primary" @click="editar">Inscribirse</button>
        </div>
        </div>
      </div>

<div class="modal fade" id="errorPass" tabindex="-1" role="dialog" aria-labelledby="errorPassLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Error</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Contraseña incorrecta</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Aceptar</button>
      </div>
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
            editar(){
                this.modoEdicion = true;
                console.log(this.curso.id);
            },
            cancelar(){
                this.modoEdicion = false;
            },
            inscribir(){
                const params = {
                    id: this.curso.id,
                    password: this.password
                };
                if (this.password === this.curso.password) {
                    axios.post('/inscripcion', params).then((res) => {
                    console.log(error.response);
                    this.modoEdicion = false;
                    const curso = res.data;
                    this.$emit('new', curso)
                })
                this.inscrito = true;
                }else{
                    $('#errorPass').modal({});
                    this.modoEdicion = false;
                    this.password = ''
                }
                
            },
    }
}

</script>