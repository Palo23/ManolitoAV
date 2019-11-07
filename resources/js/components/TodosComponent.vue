<template>

<div class="container">
    <div class="row">
    <curso-componente
        v-for="(curso, index) in cursos"
        :key="curso.id"
        :curso="curso"
        @actualizar="updateCurso(index, ...arguments)"
    ></curso-componente>
</div>
</div>

</template>

<script>

export default {
    props: ['curso'],
    data() {
        return {
            cursos: null,
            modalShow: false
        }
    },

    mounted() {
        axios.get('/inscripcion')
        .then((res) => {
            this.cursos = res.data;
        });
    },
    methods: {
        nuevoCurso(curso){
            axios.get('/inscripcion')
        .then((res) => {
            this.cursos = res.data;
        });
        },
        updateCurso(index, curso){
            this.cursos[index] = curso;
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
		}
	}
}

</script>