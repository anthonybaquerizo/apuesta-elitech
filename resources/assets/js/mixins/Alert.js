import moment from 'moment'

export default {
    name: 'help',
    data () {
        return {
            loading: false
        }  
    },
    created () {
        moment.locale('es')
    },
    filters: {
        date (value) {
            return moment(value, 'YYYY-MM-DD HH:mm:ss').fromNow()
        },
        dateHuman (value) {
            return moment(value, 'YYYY-MM-DD HH:mm:ss').format('DD MMM YYYY HH:mm A').toString().toUpperCase()
        }
    },
    methods: {
        /**
         * Captura el error y devuelve los errores
         * @param {*} param0 
         */
        catchError ({ status, data }) {
            var response = [];
            switch(status) 
            {
                case 400:
                    response.push([data.message])
                    break;
                case 404:
                        response.push(['Lo setimos error en la petición HTTP'])
                    break;
                default:
                    const errors = Object.entries(data.errors)
                    if (errors.length > 0) {
                        errors.forEach(function (value, index) {
                            response.push(value[1])
                        })
                    }
                    break;
            }
            return response
        },
        /**
         * Cierra la alerta en 5seg
         */
        closeAlert () {
            setTimeout(function() {
                this.alert.messages = []
            }.bind(this), 5000)
        }
    }
}