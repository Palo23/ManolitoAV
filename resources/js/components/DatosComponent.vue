<template>
                                <div>
                                    <table style="table-layout: fixed; width: 400%;" class="table">
                                    <tr>
                                        <th>
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
                                                <button class="btn btn-danger" type="submit" @click="modalDelUser">Eliminar</button>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿Seguro que deseás eliminar?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" @click="delUser">Confirm</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
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
