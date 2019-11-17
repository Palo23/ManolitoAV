<template>
<div class="card-body table-responsive-sm">
    <div id="busqueda" class="col-sm-12 col-md-4 hidden-sm hidden-xs" style="border-radius: 15px; padding-bottom: 35px;">
                  <h2>Buscar por nombre, correo o rol</h2> 
                  <input type="text" class="form-control" placeholder="Buscar" v-model="name">
                </div>
    <table style="table-layout: fixed; width: 100%;" class="table">
                            <thead>
                                <tr>
                                <th scope="col">Nombre de usuario</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Rol</th>
                                <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <datos-componente
                                    v-if="isAuthenticated"
                                    v-for="(usuario, index) in searchUser"
                                    :key="usuario.id"
                                    :usuario="usuario"
                                    @actualizar="updateUsuario(index, ...arguments)"
                                    @delete="borrarUsuario(index)"
                                >
                                </datos-componente>
                             </tbody>
                         </table>  

</div>    

</template>
<script>

export default {
    props: ['modal'],
    data() {
        return {
            usuarios: null,
            modalShow: false,
            name: ''
        }
    },

    mounted() {
        this.name = '';
        axios.get('/usuarios')
        .then((res) => {
            this.usuarios = res.data; 
        });
    },

    methods: {
        updateUsuario(index, usuario){
            this.usuarios[index] = usuario;
            this.$swal({
                            title: 'Modificado',
                            text: 'El usuario fue modificado exitosamente',
                            type: 'success'
                                });
        },
        borrarUsuario(index){
            this.usuarios.splice(index, 1)
            axios.get('/usuarios')
            .then((res) => {
            this.usuarios = res.data; 
            });
            this.$swal({
                            title: 'Eliminado',
                            text: 'El usuario fue eliminado exitosamente',
                            type: 'error'
                                });
        },
    },
    computed:{
		searchUser: function(){
			if(this.name === ''){
			    return this.usuarios;
			}else{
				return this.usuarios.filter((usuario)=>{
                return usuario.name.toLowerCase().includes(this.name.toLowerCase()) ||
                usuario.email.toLowerCase().includes(this.name.toLowerCase()) ||
                usuario.roles[0].nombre.toLowerCase().includes(this.name.toLowerCase());
				});
			}
		},
	}
}
</script>


