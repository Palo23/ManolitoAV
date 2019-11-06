<template>
                                <div>
                                    <table style="table-layout: fixed; width: 400%;" class="table">
                                    <tr>
                                        <th>
                                        <input v-if="modoEdicion" id="" class="form-control" type="text" v-model="curso.nombre">
                                        <p v-else>{{curso.nombre}}</p>
                                        </th>
                                        <td>
                                            <input v-if="modoEdicion" id="" class="form-control" type="text" v-model="curso.description">
                                            <p v-else>{{curso.description}}</p>
                                            </td>
                                        <td>{{curso.id_user}}</td>
                                        <td>
                                            <div v-if="modoEdicion">
                                                <button class="btn btn-success" type="submit" @click="actualizarUsuario">Guardar Cambios</button>
                                                <button class="btn btn-danger" type="submit" @click="cancelar">Cancelar</button>
                                            </div>
                                            <div v-else>
                                                <button class="btn btn-primary" type="submit" @click="editar">Editar</button>
                                                <button class="btn btn-danger" type="submit" @click="modalDelUser">Eliminar</button>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                </div>
</template>
<script>
export default {
        props: ['curso'],
        data() {
            return {
                prop: {id: '', nombre: '', description: '', foto: ''},
                modoEdicion: false,
                modoEliminar: false,
                toDeleteUserId: ''
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
                this.toDeleteUserId = this.usuario.name;
                console.log('toDeleteUserId', this.toDeleteUserId);
                $('#exampleModal').modal({});
            },
            delUser() {
                axios.delete(`usuarios/${this.usuario.id}`).then((res) => {
                    $('#exampleModal').modal('hide');
                    this.$emit('borrar');
                });
            }
        },
    }
</script>