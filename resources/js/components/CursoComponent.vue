<template>

<div class="col-sm-6 py-2">
      <div class="card">
          <img width="50" height="100" :src="curso.archivo.ruta" class="card-img-top" alt="...">
        <div v-if="inscrito">
        <div class="card-body">
        <h5 class="card-title">{{curso.nombre}}</h5>
        <input type="hidden" :value="user.id">
          <p class="card-text">{{curso.description}}</p>
          <a :href="`/vistageneral/${curso.id}`" class="btn btn-success">Entrar al curso</a>
        </div>
        </div>
        <div v-else>
            <div v-if="modoEdicion" class="card-body">
            <h5 class="card-title">{{curso.nombre}}</h5>
            <p class="card-text">{{curso.description}}</p>
            <input type="hidden" :value="curso.id">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" v-model="password">
                <button class="btn btn-primary" @click="inscribir">Inscribir curso</button>
                <button class="btn btn-danger" @click="cancelar">Cancelar</button>
        </div>
        <div v-else class="card-body">
        <h5 class="card-title">{{curso.nombre}}</h5>
        <input type="hidden" :value="user.id">
          <p class="card-text">{{curso.description}}</p>
          <button class="btn btn-primary" @click="editar">Inscribirse</button>
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
                    alert('Contraseña incorrecta');
                    this.modoEdicion = false;
                    this.password = ''
                }
                
            },
    }
}

</script>