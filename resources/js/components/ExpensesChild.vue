<template>
    <tr>
        <td>{{translation[liability.name]}}</td>
        <td>{{liability.cash_flow}}</td>
        <td>
            {{liability.child_number}}
            <button class="btn btn-primary" v-if="!newChild" v-on:click="newChild = true">Gime vaikas</button>
            <button class="btn btn-primary" v-if="newChild" v-on:click="addNewChild">Patvirtinti</button>
            <button class="btn btn-danger" v-if="newChild" v-on:click="newChild = false">Atsaukti</button>
        </td>
        <td>{{liability.child_number * liability.cash_flow}}</td>
    </tr>
</template>

<script>
    export default {
        name: 'expenses-child',
        props: {
            liability: {
                type: Object,
            },
            translation: {
                type: [Object, Boolean],
            },
        },
        methods: {
            addNewChild() {
                if (this.liability.child_number < 3) {
                    this.$emit('new-child', {
                        'id': this.liability.id,
                        'game_id': this.liability.game_id,
                        'child_number': this.liability.child_number + 1,
                    });
                    this.newChild = false;
                } else {
                    alert('Jau turi maksimalu skaiciu vaiku :)))');
                }
            }
        },
        data: function () {
            return {
                newChild: false,
                childSum: 0,
            }
        },
    }
</script>

