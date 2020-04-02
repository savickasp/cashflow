<template>
    <div class="table-responsive">
        <h2>Pajamos</h2>
        <table class="table table-sm table-bordered table-hover">
            <thead>
            <tr class="thead-dark">
                <th>Pajamu tipas</th>
                <th>Pinigu srautas</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="asset in salary" v-if="asset.cash_flow > 0">
                <td>{{translation[asset.name]}}</td>
                <td>{{asset.cash_flow}}</td>
            </tr>
            <tr>
                <td>Nekilnojamas turtas/ verslas</td>
                <th>{{this.ntBusinessSum}}</th>
            </tr>
            <tr v-for="asset in ntBusiness"  v-if="asset.cash_flow > 0">
                <td>{{asset.name}}</td>
                <td>{{asset.cash_flow}}</td>
            </tr>
            <tr>
                <td>Palukanos/ dividentai</td>
                <th>{{this.interestSum}}</th>
            </tr>
            <tr v-for="asset in interest"  v-if="asset.cash_flow > 0">
                <td>{{asset.name}}</td>
                <td>{{asset.cash_flow}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: 'income',
        props: {
            assets: {
                required: true,
                type: Array,
            },
            user: {
                type: [Object, Boolean]
            },
            translation: {
                type: [Object, Boolean],
            },
            passiveIncome: {
                required: true,
            },
            totalIncome: {
                required: true,
            }
        },
        created() {
        },
        computed: {
            salary() {
                let array = [];
                let sum = 0;

                for (let i = 0; i < this.assets.length; i++) {
                    if (this.assets[i].type === 0) {
                        sum += this.assets[i].cash_flow;
                        array.push(this.assets[i]);
                    }
                }

                this.salarySum = sum;

                this.total();

                return array;
            },
            ntBusiness() {
                let array = [];
                let sum = 0;

                for (let i = 0; i < this.assets.length; i++) {
                    if (this.assets[i].type === 2) {
                        sum += this.assets[i].cash_flow;
                        array.push(this.assets[i]);
                    }
                }

                this.ntBusinessSum = sum;

                this.total();
                this.passive();

                return array;
            },
            interest() {
                let array = [];
                let sum = 0;

                for (let i = 0; i < this.assets.length; i++) {
                    if (this.assets[i].type === 1) {
                        sum += this.assets[i].cash_flow;
                        array.push(this.assets[i]);
                    }
                }

                this.interestSum = sum;

                this.total();
                this.passive();

                return array;
            },
        },
        methods: {
            passive() {
                let sum = this.ntBusinessSum + this.interestSum;

                this.$emit('update:passiveIncome', sum);

                return sum;
            },
            total() {
                let sum = this.salarySum + this.ntBusinessSum + this.interestSum;

                this.$emit('update:totalIncome', sum);

                return sum;
            },
        },
        data: function () {
            return {
                salarySum: 0,
                ntBusinessSum: 0,
                interestSum: 0,
            }
        },
    }
</script>

