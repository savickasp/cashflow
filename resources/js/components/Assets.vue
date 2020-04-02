<template>
    <div>
        <h2>Aktyvai</h2>
        <div>
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-hover">
                    <thead>
                    <tr class="thead-dark">
                        <th>Akcijos</th>
                        <th>Kiekis</th>
                        <th>vnt. kaina</th>
                        <th>veiksmas</th>
                    </tr>
                    </thead>
                    <tbody>
                    <template v-for="asset in getStocks">
                        <assets-stocks :asset="asset" @sell-stock="sellStock"></assets-stocks>
                    </template>
                    <assets-add-stocks
                        :user="user"
                        @add-stock="addStock"
                    ></assets-add-stocks>
                    </tbody>
                </table>
            </div>
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-hover">
                    <thead>
                    <tr class="thead-dark">
                        <th>Fondai, Obligacijos</th>
                        <th>Kiekis</th>
                        <th>vnt. kaina</th>
                        <th>veiksmas</th>
                    </tr>
                    </thead>
                    <tbody>
                    <template v-for="asset in getFondsObligations">
                        <assets-fonds :asset="asset" @sell-fond="sellFond"></assets-fonds>
                    </template>
                    <assets-add-fond
                        :user="user"
                        @add-fond="addFond"
                    ></assets-add-fond>
                    </tbody>
                </table>
            </div>
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-hover">
                    <thead>
                    <tr class="thead-dark">
                        <th>NT/ verslas</th>
                        <th>kaina</th>
                        <th>veiksmas</th>
                    </tr>
                    </thead>
                    <tbody>
                    <template v-for="asset in getNtBusiness">
                        <assets-nt :asset="asset" @sell-nt="sellNt"></assets-nt>
                    </template>
                    <assets-add-nt
                        :user="user"
                        @add-nt="addNt"
                    ></assets-add-nt>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    import AssetsNt from "./AssetsNt";
    import AssetsAddNt from "./AssetsAddNt";
    export default {
        name: 'assets',
        components: {AssetsAddNt, AssetsNt},
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
        },
        created() {
        },
        computed: {
            getStocks() {
                let array = [];

                for (let i = 0; i < this.assets.length; i++) {
                    if (this.assets[i].type === 1) {
                        array.push(this.assets[i]);
                    }
                }

                return array;
            },
            getFondsObligations() {
                let array = [];

                for (let i = 0; i < this.assets.length; i++) {
                    if (this.assets[i].type === 3) {
                        array.push(this.assets[i]);
                    }
                }

                return array;
            },
            getNtBusiness() {
                let array = [];

                for (let i = 0; i < this.assets.length; i++) {
                    if (this.assets[i].type === 2) {
                        array.push(this.assets[i]);
                    }
                }

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
            addStock(data) {
                this.$emit('add-stock', data);
            },
            sellStock(data) {
                this.$emit('sell-stock', data);
            },
            addFond(data) {
                this.$emit('add-fond', data);
            },
            sellFond(data) {
                this.$emit('sell-fond', data);
            },
            addNt(data) {
                this.$emit('add-nt', data);
            },
            sellNt(data) {
                this.$emit('sell-nt', data);
            },        },
        data: function () {
            return {
                salarySum: 0,
                ntBusinessSum: 0,
                interestSum: 0,
            }
        },
    }
</script>

