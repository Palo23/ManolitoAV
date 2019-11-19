<template>

<div class="container">
<input type="hidden" :value="user.id">
    <div id="busqueda" class="col-sm-12 hidden-sm hidden-xs">
            <h2>Buscar curso</h2>
            <input type="text" class="form-control col-sm-12" placeholder="Buscar por curso o profesor" v-model="nombreMiCurso">
        </div>

    <div class="row">
    <mios-componente
        v-for="(curso, index) in searchMisCursos"
        :key="curso.id"
        :curso="curso"
    ></mios-componente>
</div>
</div>

</template>

<script>

export default {
    props: ['curso'],
    data() {
        return {
            cursos: null,
            modalShow: false,
            nombreMiCurso: ''
        }
    },

    mounted() {
        axios.get('/misCursos')
        .then((res) => {
            this.cursos = res.data;
            });
            
    },
    methods: {
        nuevoCurso(curso){
            axios.get('/misCursos')
        .then((res) => {
            this.cursos = res.data;
        });
        },
        updateCurso(index, curso){
            this.cursos[index] = curso;
        },
    },
    computed:{
		searchMisCursos: function(){
			if(this.nombreMiCurso === ''){
                return this.cursos;
			    /* return this.cursos.filter((curso)=>{
                return curso.users.find(user => user.id == this.user.id);
            }); */
			}else{
				return this.cursos.filter((curso)=>{
                return curso.nombre.toLowerCase().includes(this.nombreMiCurso.toLowerCase()) ||
                curso.profesor.name.toLowerCase().includes(this.nombreMiCurso.toLowerCase());
				});
			}
        },
	}
}

</script>