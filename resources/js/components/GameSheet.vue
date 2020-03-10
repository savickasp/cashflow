<template>
    <div>
        <income
            :assets="assets"
            :user="user"
        ></income>
    </div>
</template>

<script>
    import income from './Income';

    export default {
        name: 'game-sheet',
        components: {
            income,
        },
        created() {
            this.getAssets();
            this.getLiabilities();
        },
        props: {
            user: {
                type: [Object, Boolean],
            },
        },
        methods: {
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
            }
        },
        data: function () {
            return {
                assets: [],
                liabilities: [],
            }
        },
    }
</script>

