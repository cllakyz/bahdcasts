<template>
    <div>
        <button class="btn btn-success" @click="subscribe('monthly')">Subscribe to $9.99 Monthly</button>
        <button class="btn btn-info" @click="subscribe('yearly')"> Subscribe to $99.9 Yearly</button>
    </div>
</template>

<script>
    export default {
        name: "Stripe",
        props: ['email'],
        data(){
            return{
                plan: '',
                amount: 0,
                handler: null
            }
        },
        mounted() {
            this.handler = StripeCheckout.configure({
                key: 'pk_test_SKd1xNvf6QPxPBDOTHcev7QW00BOg7SQQp',
                image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
                locale: 'auto',
                token(token) {

                }
            });
        },
        methods: {
            subscribe(plan){
                if(plan === 'monthly') {
                    window.stripePlan = 'monthly';
                    this.amount = 999;
                } else {
                    window.stripePlan = 'yearly';
                    this.amount = 9999;
                }

                this.handler.open({
                    name: 'Bahdcasts',
                    description: 'Bahdcasts Subscription',
                    amount: this.amount,
                    email: this.email
                });
            }
        }
    }
</script>

<style scoped>

</style>