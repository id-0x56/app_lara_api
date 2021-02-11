<template>
    <app-layout>
        <jet-loader :on="is_load" />

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                House
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <jet-label for="name" value="Name" />
                <jet-input id="name" type="text" class="mt-1 block w-1/2 mb-6" v-model="params.name" />

                <div class="flex">
                    <div>
                        <jet-label for="price_start" value="Start price" />
                        <jet-input id="price_start" type="text" class="mt-1 block mb-6 mr-8" v-model="params.price_start" />
                    </div>
                    <div>
                        <jet-label for="price_end" value="End price" />
                        <jet-input id="price_end" type="text" class="mt-1 block mb-6 mr-8" v-model="params.price_end" />
                    </div>

                    <div>
                        <jet-button @click.native="search" class="mt-7">
                            Search
                        </jet-button>
                    </div>
                </div>

                <jet-label for="bedroom" value="Bedroom" />
                <jet-input id="bedroom" type="text" class="mt-1 block w-1/2 mb-6" v-model="params.bedroom" />

                <jet-label for="bathroom" value="Bathroom" />
                <jet-input id="bathroom" type="text" class="mt-1 block w-1/2 mb-6" v-model="params.bathroom" />

                <jet-label for="storey" value="Storey" />
                <jet-input id="storey" type="text" class="mt-1 block w-1/2 mb-6" v-model="params.storey" />

                <jet-label for="garage" value="Garage" />
                <jet-input id="garage" type="text" class="mt-1 block w-1/2 mb-6" v-model="params.garage" />

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                    <table class="table-fixed w-full">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 w-20">#</th>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Price</th>
                                <th class="px-4 py-2">Bedroom</th>
                                <th class="px-4 py-2">Bathroom</th>
                                <th class="px-4 py-2">Storey</th>
                                <th class="px-4 py-2">Garage</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="house in houses">
                                <td class="border px-4 py-2">{{ house.id }}</td>
                                <td class="border px-4 py-2">{{ house.name }}</td>
                                <td class="border px-4 py-2">{{ house.price }}</td>
                                <td class="border px-4 py-2">{{ house.bedroom }}</td>
                                <td class="border px-4 py-2">{{ house.bathroom }}</td>
                                <td class="border px-4 py-2">{{ house.storey }}</td>
                                <td class="border px-4 py-2">{{ house.garage }}</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                <jet-alert :on="is_alert">Nothing found</jet-alert>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import JetButton from '@/Jetstream/Button'
    import JetLabel from '@/Jetstream/Label'
    import JetInput from '@/Jetstream/Input'
    import JetAlert from '@/Pages/House/Alert'
    import JetLoader from '@/Pages/House/Loader'

    export default {

        components: {
            AppLayout,
            JetButton,
            JetLabel,
            JetInput,
            JetAlert,
            JetLoader,
        },

        data() {
            return {
                houses: '',

                is_alert: false,
                is_load: false,

                params: {
                    name: '',
                    price_start: '',
                    price_end: '',
                    bedroom: '',
                    bathroom: '',
                    storey: '',
                    garage: ''
                },
            }
        },

        methods: {
            search() {
                this.is_load = true
                Object.keys(this.params).map(key => this.params[key] = typeof this.params[key] == 'string' ? this.params[key].trim() : this.params[key])

                let query = '?'
                query += this.params.name !== '' ? 'name=' + this.params.name + '&' : ''
                query += this.params.price_start !== '' ? 'price_start=' + this.params.price_start + '&' : ''
                query += this.params.price_end !== '' ? 'price_end=' + this.params.price_end + '&' : ''
                query += this.params.bedroom !== '' ? 'bedroom=' + this.params.bedroom + '&' : ''
                query += this.params.bathroom !== '' ? 'bathroom=' + this.params.bathroom + '&' : ''
                query += this.params.storey !== '' ? 'storey=' + this.params.storey + '&' : ''
                query += this.params.garage !== '' ? 'garage=' + this.params.garage + '&' : ''
                query = query.slice(0, query.length - 1)

                axios.get('/api/house' + query)
                    .then(response => {
                        setTimeout(() => {
                            this.is_load = false
                            this.is_alert = response.data.houses.length == 0

                            this.houses = response.data.houses
                        }, 1500)
                    })
            },
        },

        mounted() {
            this.search()
        }

    }
</script>
