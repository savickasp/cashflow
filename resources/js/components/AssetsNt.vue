<template>
    <tr v-if="asset.quantity > 0">
        <td>{{asset.name}}</td>
        <td>{{asset.price}}</td>
        <td>
            <button class="btn btn-primary" v-if="!sell" v-on:click="sell = true">Parduoti</button>
            <button class="btn btn-primary" v-if="sell" v-on:click="saveChanges">Patvirtinti</button>
            <button class="btn btn-danger" v-if="sell" v-on:click="sell = false">Atsaukti</button>
        </td>
    </tr>
</template>

<script>
    export default {
        name: 'assets-nt',
        props: {
            asset: {
                type: [Object]
            },
            translation: {
                Object
            },
        },
        created() {
        },
        computed: {},
        methods: {
            saveChanges() {
                this.$emit('sell-nt', {
                    'id': this.asset.id,
                    'game_id': this.asset.game_id,
                    'quantity': 0,
                });
                this.sell = false;
            },
        },
        data: function () {
            return {
                sell: false,
            }
        },
    }
</script>

