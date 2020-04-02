<template>
    <div>
        <div class="table-responsive">
            <h2>Mesenio ataskaita</h2>
            <table class="table table-sm table-bordered table-hover">
                <thead>
                <tr class="thead-dark">
                    <th>pavadinimas</th>
                    <th> pinigu srautas</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Pajamos</td>
                    <td>{{this.totalIncome}}</td>
                </tr>
                <tr>
                    <td>Pasyvios pajamos</td>
                    <td>{{this.passiveIncome}}</td>
                </tr>
                <tr>
                    <td>Islaidos</td>
                    <td>{{this.totalExpenses}}</td>
                </tr>
                <tr>
                    <td>Pasyvios pajamos - islaidos</td>
                    <td>{{this.passiveMinusExpenses}}</td>
                </tr>
                <tr>
                    <td>Menesio srautas</td>
                    <td>{{this.monthCashFlow}}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <income
            :assets="assets"
            :user="user"
            :translation="translation"
            v-bind:passiveIncome.sync="passiveIncome"
            v-bind:totalIncome.sync="totalIncome"
            @total-income="setTotalIncome($event)"
            @passive-income="setPassiveIncome($event)"
        ></income>
        <expenses
            :liabilities="liabilities"
            :user="user"
            :translation="translation"
            v-bind:totalExpenses.sync="totalExpenses"
            @new-child="newChild"
        ></expenses>
        <assets
            :assets="assets"
            :user="user"
            :translation="translation"
            @add-stock="addStock"
            @sell-stock="sellStock"
            @add-fond="addFond"
            @sell-fond="sellFond"
            @add-nt="addNt"
            @sell-nt="sellNt"
        ></assets>
        <liabilities
            :liabilities="liabilities"
            :user="user"
            :translation="translation"
            @loan-repay="loanRepay($event)"
            @take-loan="takeLoan($event)"
        ></liabilities>
    </div>
</template>

<script>
    import income from './Income';
    import expenses from './Expenses';
    import assets from './Assets';
    import liabilities from './Liabilities';

    export default {
        name: 'game-sheet',
        components: {
            income,
            expenses,
            assets,
            liabilities,
        },
        created() {
            this.getAssets();
            this.getLiabilities();
        },
        props: {
            user: {
                type: [Object, Boolean],
            },
            translation: {
                type: [Object, Boolean],
            }
        },
        computed: {
            passiveMinusExpenses() {
                return this.passiveIncome - this.totalExpenses;
            },
            monthCashFlow() {
                return this.totalIncome - this.totalExpenses;
            },
        },
        methods: {
            liabilityIndex: function (data) {
                return this.liabilities.findIndex((element) => {
                    return element.id === data;
                });
            },
            getAssets: function () {
                axios.get('/api/user/' + this.user.id + '/game/' + this.user.game_id + '/asset/all?api_token=' + this.user.api_token)
                    .then(({data}) => {
                        this.assets = data;
                    })
            },
            getLiabilities: function () {
                axios.get('/api/user/' + this.user.id + '/game/' + this.user.game_id + '/liability/all?api_token=' + this.user.api_token)
                    .then(({data}) => {
                        this.liabilities = data;
                    })
            },
            gameSheet: function () {
                return this;
            },
            setTotalIncome: function (data) {
                this.totalIncome = data.totalIncome;
            },
            setPassiveIncome: function (data) {
                this.passiveIncome = data.passiveIncome;
            },
            loanRepay: function (data) {
                axios.put('/api/user/' + this.user.id + '/game/' + this.user.game_id + '/loan/repay?api_token=' + this.user.api_token, data)
                    .then((data) => {
                        this.liabilities[this.liabilityIndex(data.data.id)].cash_flow = data.data.cash_flow;
                        this.liabilities[this.liabilityIndex(data.data.id)].loan_size = data.data.loan_size;
                    })
            },
            takeLoan: function (data) {
                axios.put('/api/user/' + this.user.id + '/game/' + this.user.game_id + '/loan/take?api_token=' + this.user.api_token, data)
                    .then((data) => {
                        this.liabilities[this.liabilityIndex(data.data.id)].cash_flow = data.data.cash_flow;
                        this.liabilities[this.liabilityIndex(data.data.id)].loan_size = data.data.loan_size;
                    })
            },
            addStock(data) {
                axios.put('/api/user/' + this.user.id + '/game/' + this.user.game_id + '/stock/add?api_token=' + this.user.api_token, data)
                    .then(() => {
                        this.getAssets();
                    })
            },
            sellStock(data) {
                axios.patch('/api/user/' + this.user.id + '/game/' + this.user.game_id + '/stock/sell?api_token=' + this.user.api_token, data)
                    .then(() => {
                        this.getAssets();
                    })
            },
            addFond(data) {
                axios.put('/api/user/' + this.user.id + '/game/' + this.user.game_id + '/fond/add?api_token=' + this.user.api_token, data)
                    .then(() => {
                        this.getAssets();
                    })
            },
            sellFond(data) {
                axios.patch('/api/user/' + this.user.id + '/game/' + this.user.game_id + '/fond/sell?api_token=' + this.user.api_token, data)
                    .then(() => {
                        this.getAssets();
                    })
            },
            addNt(data) {
                axios.put('/api/user/' + this.user.id + '/game/' + this.user.game_id + '/nt/add?api_token=' + this.user.api_token, data)
                    .then(() => {
                        this.getAssets();
                    })
            },
            sellNt(data) {
                axios.patch('/api/user/' + this.user.id + '/game/' + this.user.game_id + '/nt/sell?api_token=' + this.user.api_token, data)
                    .then(() => {
                        this.getAssets();
                    })
            },
            newChild(data) {
                axios.patch('/api/user/' + this.user.id + '/game/' + this.user.game_id + '/child?api_token=' + this.user.api_token, data)
                    .then(() => {
                        this.getLiabilities();
                    })
            }
        },
        data: function () {
            return {
                assets: [],
                liabilities: [],
                totalIncome: 0,
                passiveIncome: 0,
                totalExpenses: 0,
            }
        },
    }
</script>

