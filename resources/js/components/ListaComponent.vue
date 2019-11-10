<template>
                                <div>
                                    <table style="table-layout: fixed; width: 400%;" class="table">
                                    <tr>
                                        <th>
                                        <input v-if="modoEdicion" id="" class="form-control" type="text" v-model="curso.nombre">
                                        <p v-else><a :href="`/vistageneral/${curso.id}`">{{curso.nombre}}</a></p>
                                        </th>
                                        <td>
                                            <input v-if="modoEdicion" id="" class="form-control" type="text" v-model="curso.description">
                                            <p v-else>{{curso.description}}</p>
                                            </td>
                                        <td>
                                            <a :href="`/editarCurso/${curso.id}`"><img width="50" height="50" :src="curso.archivo.ruta" alt="..."></a></td>
                                        <td>
                                            <div v-if="modoEdicion">
                                                <button class="btn btn-success" type="submit" @click="actualizarCurso">Guardar Cambios</button>
                                                <button class="btn btn-danger" type="submit" @click="cancelar">Cancelar</button>
                                            </div>
                                            <div v-else>
                                                <a class="btn btn-primary" @click="editar">Editar</a>
                                                <button class="btn btn-secondary" type="submit" @click="modalDelCurso">Eliminar</button>
                                            </div>
                                        </td>
                                    </tr>
                                </table>

<div class="modal fade" id="borrarCursoModal" tabindex="-1" role="dialog" aria-labelledby="borrarCursoModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar curso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿Seguro que deseás eliminar? | {{this.toDeleteCursoId}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" @click="delCurso">Confirmar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
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
                prop: {id: '', nombre: '', description: '', foto: ''},
                modoEdicion: false,
                modoEliminar: false,
                toDeleteCursoId: '',
                nombre: '',
                descripcion: ''
            }
        },
        methods: {
            editar(){
                this.modoEdicion = true;
            },
            cancelar(){
                this.modoEdicion = false;
            },
            actualizarCurso(){
                const params = {
                    nombre: this.curso.nombre,
                    descripcion: this.curso.description
                };
                axios.put(`/cursosCreacion/${this.curso.id}`, params).then((res) => {
                    this.modoEdicion = false;
                    const curso = res.data;
                    this.$emit('actualizar', curso)
                })
            },
            modalDelCurso(){
                this.toDeleteCursoId = this.curso.id;
                console.log('toDeleteCursoId', this.toDeleteCursoId);
                $('#borrarCursoModal').modal({});
            },
            delCurso() {
                axios.delete(`/cursosCreacion/${this.curso.id}`).then((res) => {
                    $('#borrarCursoModal').modal('hide');
                    this.$emit('borrar');
                });
            }
        },
    }
</script>