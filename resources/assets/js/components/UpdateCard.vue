import Swal from "sweetalert2";
<template>
    <div>
        <button class="btn btn-success" @click="update">Update card details</button>
    </div>
</template>

<script>
    import Axios from "axios";
    import Swal from "sweetalert2";

    export default {
        name: "UpdateCard",
        props: ['email'],
        data(){
            return{
                handler: null
            }
        },
        mounted() {
            this.handler = StripeCheckout.configure({
                key: 'pk_test_SKd1xNvf6QPxPBDOTHcev7QW00BOg7SQQp',
                image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
                locale: 'auto',
                allowRememberMe: false,
                token(token) {
                    Swal.fire({ text: 'Please wait while we update your card details ...', showConfirmButton: false });
                    Axios.post('card/update', {
                        stripeToken: token.id,
                    })
                    .then(resp => {
                        Swal.fire({ text: 'Successfully subscribed', icon: 'success' })
                            .then(() => {
                                window.location.reload();
                            });
                    });
                }
            });
        },
        methods:{
            update(){
                this.handler.open({
                    name: 'Bahdcasts',
                    description: 'Bahdcasts Subscription',
                    email: this.email,
                    panelLabel: 'Update Card Details'
                });
            }
        }
    }
</script>

<style scoped>

</style>