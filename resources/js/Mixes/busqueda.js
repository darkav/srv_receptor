const busqueda =
{
    data: () => {
        return {
            
            searched:""
        }
    },
    computed:{
        getFiltro()
        {
            var my = this;
            return this.getData.filter((fila) => {
                return JSON.stringify(fila).toLocaleUpperCase().includes(my.searched.toLocaleUpperCase());
            });
        }
    }

};

export default busqueda;