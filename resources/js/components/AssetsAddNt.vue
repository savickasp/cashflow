<template>
    <tr>
        <template v-if="addNew">
            <td><input class="form-control" v-model="name"></td>
            <td>
                <div class="form-group">
                    <span>ivesk pinigu srauta:</span>
                    <input class="form-control" v-model="cash_flow">
                </div>
                <div class="form-group">
                    <span>ivesk kaina:</span>
                    <input class="form-control" v-model="price">
                </div>
            </td>
            <td>
                <button class="btn btn-primary" v-on:click="saveChanges">Pirkti</button>
                <button class="btn btn-danger" v-on:click="revertChanges">Atšaukti</button>
            </td>
        </template>
        <template v-if="!addNew">
            <td colspan="4">
                <span class="d-flex justify-content-center">
                <button class="btn btn-success" v-on:click="addNew = true">Pridėti nauja</button>
                </span>
            </td>
        </template>

    </tr>
</template>

<script>
    export default {
        name: 'assets-add-nt',
        props: {
            user: {
                type: [Object, Boolean]
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
                this.name = '';
                this.price = 0;
                this.cash_flow = 0;
                this.addNew = false;
            },
            saveChanges() {
                if (this.name !== '' && this.cash_flow > 0 && this.price > 0) {
                    this.$emit('add-nt', {
                        'name': this.name,
                        'quantity': 1,
                        'cash_flow': this.cash_flow,
                        'price': this.price,
                        'type': this.type,
                        'user_id': this.user.id,
                        'game_id': this.user.game_id,
                    });
                    this.addNew = false;
                } else {
                    alert('Ne visi laukeliai buvo užpildyti!');
                }
            },
        },
        data: function () {
            return {
                addNew: false,
                name: '',
                price: 0,
                cash_flow: 0,
                type: 2,
            }
        },
    }
</script>

