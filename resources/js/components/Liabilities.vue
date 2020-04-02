<template>
    <div>
        <h2>Pasyvai</h2>
        <div>
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-hover">
                    <thead>
                    <tr class="thead-dark">
                        <th>Įsipareigojimas</th>
                        <th>suma</th>
                        <th>Veiksmas</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th colspan="3">Paskolos</th>
                    </tr>
                    <liabilities-loans
                        v-for="liability in getLoans"
                        v-bind:key="liability.id"
                        :loan="liability"
                        :translation="translation"
                        @loan-repay="loanRepay($event)"
                        @take-loan="takeLoan($event)"
                    ></liabilities-loans>
                    <tr>
                        <th colspan="3">NT/ verslas</th>
                    </tr>
                    <tr v-for="liability in getNtBusiness">
                        <td>{{translation[liability.name]}}</td>
                        <td>{{liability.loan_size}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'expenses',
        props: {
            liabilities: {
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
            getLoans() {
                let array = [];

                for (let i = 0; i < this.liabilities.length; i++) {
                    if (this.liabilities[i].type === 2) {
                        array.push(this.liabilities[i]);
                    }
                }

                return array;
            },
            getNtBusiness() {
                let array = [];

                for (let i = 0; i < this.liabilities.length; i++) {
                    if (this.liabilities[i].type === 3) {
                        array.push(this.liabilities[i]);
                    }
                }

                return array;
            },
        },
        methods: {
            total() {
                let sum = this.childSum + this.fixedSum + this.loansSum + this.ntBusinessSum;

                this.$emit('update:totalExpenses', sum);

                return sum;
            },
            loanRepay: function(data) {
                this.$emit('loan-repay', data );
            },
            takeLoan(data) {
                this.$emit('take-loan', data );
            }
        },
        data: function () {
            return {
                childSum: 0,
                fixedSum: 0,
                loansSum: 0,
                ntBusinessSum: 0,
            }
        },
    }
</script>

