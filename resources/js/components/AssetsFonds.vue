<template>
    <tr v-if="asset.quantity > 0">
        <template v-if="sell">
            <td>{{asset.name}}</td>
            <td>
                Pardavus gausi: {{quantity * price}}
                <input class="form-control" v-model="quantity"></td>
            <td>
                <span>Pirkimo kaina: {{asset.price}}</span>
                <div class="form-group">
                    Pardavimo kaina:
                <input class="form-control" v-model="price">
                </div>
                </td>
            <td>
                <button class="btn btn-primary" v-on:click="saveChanges">Parduoti</button>
                <button class="btn btn-danger" v-on:click="revertChanges">Atšaukti</button>
            </td>
        </template>
        <template v-if="!sell">
            <td>{{asset.name}}</td>
            <td>{{asset.quantity}}</td>
            <td>{{asset.price}}</td>
            <td>
                <button class="btn btn-success" v-on:click="setSellData">Parduoti</button>
            </td>
        </template>

    </tr>
</template>

<script>
    export default {
        name: 'assets-fonds',
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
            revertChanges() {
                this.quantity = 0;
                this.price = 0;
                this.sell = false;
            },
            setSellData() {
                this.quantity = this.asset.quantity;
                this.price = this.asset.price;
                this.sell = true;
            },
            saveChanges() {
                if (this.quantity <= this.asset.quantity && this.quantity > 0) {
                    this.$emit('sell-fond', {
                        'id': this.asset.id,
                        'game_id': this.asset.game_id,
                        'quantity': this.asset.quantity - this.quantity,
                    });
                    this.sell = false;
                } else {
                    alert('Nurodytas blogas kiekis. Parduodamas kiekis turi buti didesnis nei 0 ir mazesnis arba lygus turimam kiekiui');
                }
            },
        },
        data: function () {
            return {
                sell: false,
                quantity: 0,
                price: 0,
            }
        },
    }
</script>

