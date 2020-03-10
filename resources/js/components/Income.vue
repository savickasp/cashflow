<template>
    <div>
        <h2>Pajamos</h2>
        <table>
            <thead>
            <tr>
                <th>Pajamu tipas</th>
                <th>Pinigu srautas</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Atliginimas</td>
                <th>{{this.salarySum}}</th>
            </tr>
            <tr v-for="asset in salary">
                <td>Darbas</td>
                <td>{{asset.cash_flow}}</td>
            </tr>
            <tr>
                <td>Nekilnojamas turtas/ verslas</td>
                <th>{{this.ntBusinessSum}}</th>
            </tr>
            <tr v-for="asset in ntBusiness">
                <td>{{asset.name}}</td>
                <td>{{asset.cash_flow}}</td>
            </tr>
            <tr>
                <td>Palukanos/ dividentai</td>
                <th>{{this.interestSum}}</th>
            </tr>
            <tr v-for="asset in interest">
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

                return array;
            },
            passive() {
                return  this.ntBusinessSum + this.interestSum;
            },
            total() {
                return  this.salarySum + this.passive;
            },
        },
        methods: {},
        data: function () {
            return {
                salarySum: 0,
                ntBusinessSum: 0,
                interestSum: 0,
            }
        },
    }
</script>

