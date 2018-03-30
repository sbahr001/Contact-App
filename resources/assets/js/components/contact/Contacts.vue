<template>
    <div id="v-for-contacts" class="">
        <div v-for=" contact in contacts" class="">
            <img v-bind:src="contact.photo" />
            <ul>
                <li v-for="(contactValues, field) in contact">
                    <div v-if="Array.isArray(contactValues)">
                        <p> {{ field }}:</p>
                        <ul>
                            <li v-for="(value) in contactValues" >
                                {{ value }}
                            </li>
                        </ul>
                    </div>
                    <div v-else>
                        <p> {{ field }}: {{ contactValues }}</p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {

        data() {
            return {
                contacts: [],
            }
        },

        mounted() {
            this.prepareComponent()
        },

        methods: {
            prepareComponent() {
                this.getContacts();
            },

            getContacts() {

                axios.get('api/v1/contacts')
                    .then(response => {
                        this.contacts = response.data.data
                    })
            }

        }
    }
</script>

<style scoped>

</style>