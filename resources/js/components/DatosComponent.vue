<template>
                                <div>
                                    <table style="table-layout: fixed; width: 400%;" class="table">
                                    <tr>
                                        <th>
                                        <input type="hidden" :value="user.id">
                                        <input type="hidden" :value="usuario.id">
                                        <input v-if="modoEdicion" id="" class="form-control" type="text" v-model="usuario.name">
                                        <p v-else>{{usuario.name}}</p>
                                        </th>
                                        <td>
                                            <input v-if="modoEdicion" id="" class="form-control" type="text" v-model="usuario.email">
                                            <p v-else>{{usuario.email}}</p>
                                            </td>
                                        <td>{{usuario.roles[0].nombre}}</td>
                                        <td>
                                            <div v-if="modoEdicion">
                                                <button class="btn btn-success" type="submit" @click="actualizarUsuario">Guardar Cambios</button>
                                                <button class="btn btn-danger" type="submit" @click="cancelar">Cancelar</button>
                                            </div>
                                            <div v-else>
                                                <button class="btn btn-primary" type="submit" @click="editar">Editar</button>
                                                <button class="btn btn-secondary" type="submit" @click="modalDelUser">Eliminar</button>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                </div>
</template>

<script>

    export default {
        props: ['usuario'],
        data() {
            return {
                prop: {id: '', name: '', email: '', rol: ''},
                modoEdicion: false,
                modoEliminar: false,
                toDeleteUserId: '',
                toDeleteUser2: '',
                borrar: false
            }
        },
        methods: {
            editar(){
                this.modoEdicion = true;
            },
            cancelar(){
                this.modoEdicion = false;
            },
            actualizarUsuario(){
                const params = {
                    name: this.usuario.name,
                    email: this.usuario.email
                };
                axios.put(`/usuarios/${this.usuario.id}`, params).then((res) => {
                    this.modoEdicion = false;
                    const usuario = res.data;
                    this.$emit('actualizar', usuario)
                })
            },
            modalDelUser(){
                var id
                var authID
                authID = this.user.id
                id = this.usuario.id
                Vue.swal({
                    title: "¿Estás seguro de eliminar al usuario?",
                    text: `${this.usuario.name}`,
                    type: "question",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Sí",
                    showCancelButton: true,
                    cancelButtonText: "Cancelar"
                    }).then(function(isConfirm) {
                            if (isConfirm.value) {
                                if (authID === id) {
                                    Vue.swal("Error", "No se puede borrar la sesión actual", "error");
                                } else {
                                    axios.delete(`/usuarios/${id}`).then((res) => {
                                        Vue.swal({
                                            title: "Eliminado", 
                                            text: "El usuario ha sido eliminado", 
                                            type: "success",
                                            allowEscapeKey: false,
                                            allowOutsideClick: false}).then(function(){ 
                                            location.reload();
                                            });
                                    });
                                }
                            }
                           
                    });
            },
        },
    }
</script>
