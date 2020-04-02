<template>
    <div class="table-responsive">
        <h2>Islaidos</h2>
        <table class="table table-sm table-bordered table-hover">
            <thead>
            <tr class="thead-dark">
                <th>Islaidu tipas</th>
                <th>islaidos vaikui</th>
                <th>vaiku sk.</th>
                <th>Pinigu srautas</th>
            </tr>
            </thead>
            <tbody>
            <!--            child expenses-->
            <expenses-child
                v-for="liability in childs"
                v-bind:key="liability.id"
                :liability="liability"
                :translation="translation"
                @child-sum="setChildSum"
                @new-child="addNewChild"
            ></expenses-child>
            <!--            fixed expenses-->
            <tr class="thead-dark">
                <th colspan="3">Islaidu tipas</th>
                <th>pinigu srautas</th>
            </tr>
            <tr v-for="liability in fixed">
                <td colspan="3">{{translation[liability.name]}}</td>
                <td>{{liability.cash_flow}}</td>
            </tr>
            <!--            loans-->
            <tr v-for="liability in loans">
                <td colspan="3">{{translation[liability.name]}}</td>
                <td>{{liability.cash_flow}}</td>
            </tr>
            <!--            NT loans-->
            <tr v-for="liability in ntBusiness">
                <td colspan="3">{{translation[liability.name]}}</td>
                <td>{{liability.cash_flow}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import ExpensesChild from "./ExpensesChild";

    export default {
        name: 'expenses',
        components: {ExpensesChild},
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
            totalExpenses: {
                required: true,
            }
        },
        created() {
        },
        computed: {
            childs() {
                let array = [];
                let sum = 0;

                for (let i = 0; i < this.liabilities.length; i++) {
                    if (this.liabilities[i].type === 1) {
                        sum += this.liabilities[i].cash_flow * this.liabilities[i].child_number;
                        array.push(this.liabilities[i]);
                    }
                }

                this.childSum = sum;

                this.total();

                return array;
            },
            fixed() {
                let array = [];
                let sum = 0;

                for (let i = 0; i < this.liabilities.length; i++) {
                    if (this.liabilities[i].type === 0) {
                        sum += this.liabilities[i].cash_flow;
                        array.push(this.liabilities[i]);
                    }
                }

                this.fixedSum = sum;

                this.total();

                return array;
            },
            loans() {
                let array = [];
                let sum = 0;

                for (let i = 0; i < this.liabilities.length; i++) {
                    if (this.liabilities[i].type === 2) {
                        sum += this.liabilities[i].cash_flow;
                        array.push(this.liabilities[i]);
                    }
                }

                this.loansSum = sum;

                this.total();

                return array;
            },
            ntBusiness() {
                let array = [];
                let sum = 0;

                for (let i = 0; i < this.liabilities.length; i++) {
                    if (this.liabilities[i].type === 3) {
                        sum += this.liabilities[i].cash_flow;
                        array.push(this.liabilities[i]);
                    }
                }

                this.ntBusinessSum = sum;

                this.total();

                return array;
            },
        },
        methods: {
            setChildSum(data) {
                this.childSum = data;
            },
            total() {
                let sum = this.childSum + this.fixedSum + this.loansSum + this.ntBusinessSum;

                this.$emit('update:totalExpenses', sum);

                return sum;
            },
            addNewChild(data) {
                this.$emit('new-child', data)
            },
        },
        data: function () {
            return {
                childSum: 0,
                fixedSum: 0,
                loansSum: 0,
                ntBusinessSum: 0,
                newChild: false,
            }
        },
    }
</script>

