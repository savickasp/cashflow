<template>
    <tr>
        <td>{{translation[loan.name]}}</td>
        <td v-if="!repayingLoan && !takingLoan">{{loan.loan_size}}</td>
        <td v-if="repayingLoan && !takingLoan">
            Grazinama suma: <input class="form-control" value="loan.loan_size" type="number" v-model="repaysize">
        </td>
        <td v-if="takingLoan">
            Paskolos suma: <input class="form-control" value="loansize" type="number" v-model="loansize"> piginu srautas: {{loansize * 0.1}}
        </td>
        <td>
            <button class="btn btn-success" v-if="!repayingLoan && !takingLoan" v-on:click="repayingLoan = true">Gražinti</button>
            <button class="btn btn-danger" v-if="!repayingLoan && !takingLoan && this.loan.name === 'bank_loan'" v-on:click="takeLoan">Skolintis</button>
            <button class="btn btn-primary" v-if="repayingLoan" v-on:click="repayLoan">Išsaugoti</button>
            <button class="btn btn-primary" v-if="takingLoan" v-on:click="saveLoan">Patvirtinti</button>
            <button class="btn btn-danger" v-if="repayingLoan || takingLoan" v-on:click="cancel">Atšaukti</button>
        </td>
    </tr>
</template>

<script>
    export default {
        name: 'liabilities-loans',
        props: {
            loan: {
                Object
            },
            translation: {
                Object
            },
        },
        created() {
        },
        computed: {},
        methods: {
            repayLoan() {
                if (this.repaysize > 0 && this.repaysize <= this.loan.loan_size) {
                    this.repayingLoan = false;
                    this.$emit('loan-repay', {
                        'loan_size': this.repaysize,
                        'game_id': this.loan.game_id,
                        'id': this.loan.id,
                    });
                } else  {
                    alert('Ivesta netinkama paskolos gražinimo suma')
                }
            },
            saveLoan() {
                if (this.loansize > 0) {
                    this.takingLoan = false;
                    this.$emit('take-loan', {
                        'loan_size': this.loansize,
                        'cash_flow': this.loansize * 0.1,
                        'game_id': this.loan.game_id,
                        'id': this.loan.id,
                    });
                    this.loansize = 0;

                } else  {
                    alert('Suma turi buti didesne nei 0')
                }
            },
            takeLoan() {
                this.takingLoan = true;
            },
            cancel() {
                this.repayingLoan = false;
                this.takingLoan = false;
            },
        },
        data: function () {
            return {
                repayingLoan: false,
                takingLoan: false,
                repaysize: 0,
                loansize: 0,
            }
        },
    }
</script>

