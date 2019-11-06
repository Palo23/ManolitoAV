<template>

<div class="container">
    <div class="card-body">
        <div class="card-header d-flex justify-content-between align-items-center">
        <div id="busqueda" class="col-sm-12 col-md-4 hidden-sm hidden-xs" style="border-radius: 2px; padding-bottom: 2px;">
            <h2>Buscar curso</h2>
            <input type="text" class="form-control" placeholder="Buscar">
        </div>
        <button class="p-2 bd-highlight btn btn-success" @click="modalCrear">Crear Curso</button>
    </div>
    </div>

    <table style="table-layout: fixed; width: 100%;" class="table">
                            <thead>
                                <tr>
                                <th scope="col">Nombre del curso</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Imagen</th>
                                <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <lista-componente
                                    v-for="(curso) in cursos"
                                    :key="curso.id"
                                    :curso="curso"
                                ></lista-componente>
                             </tbody>
                         </table>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear Curso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <modal-componente
        @new="agregarCurso"
        ></modal-componente>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>


</div>


</template>

<script>
export default {
    data() {
        return {
            cursos: [],
            nombreCurso: '',
        }
    },
    mounted() {
        this.nombreCurso = '';
        axios.get('/cursosCreacion')
        .then((res) => {
            this.cursos = res.data;
        });
    },
    updated(){
        this.nombreCurso = '';
        axios.get('/cursosCreacion')
        .then((res) => {
            this.cursos = res.data;
        });
    },
    methods: {
        modalCrear(){
                $('#exampleModal').modal({});
            },
        agregarCurso(nuevoCurso){
            $('#exampleModal').modal('hide');
        },
    }
}
</script>