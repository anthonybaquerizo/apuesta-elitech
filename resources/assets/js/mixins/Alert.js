import moment from 'moment'

export default {
    data () {
        return {
            alert: {
                type: '',
                title: '',
                messages: []
            },
            loading: false
        }  
    },
    components: {
        
    },
    created () {
        moment.locale('es')
    },
    filters: {
        date (value) {
            return moment(value, 'YYYY-MM-DD HH:ii:ss').fromNow()
        }
    },
    methods: {
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
        closeAlert () {
            setTimeout(function() {
                this.alert.messages = []
            }.bind(this), 5000)
        }
    }
}