<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <title>Document</title>
</head>

<body>
    <div id="app" class="ui container">
        <h1>Github Profiles</h1>
        <div class="ui cards">
            <github-user-card v-for="student in  students" v-bind:key="student.id" :username="student.id"
                :koreanname="student.name">
            </github-user-card>
        </div>
    </div>

    <script type="text/x-template" id="github-user-card-template">
        <div class="ui card">
            <span class="date">@{{ koreanname }}</span>
            <div class="image">
                <img :src="user.avatar_url">
            </div>
            <div class="content">
                <a :href="`https://github.com/${username}`" class="header">@{{ user . name }}</a>
                <div class="meta">
                    <span class="date">@{{ user . created_at }}</span>
                </div>
                <div class="description">
                    @{{ user . bio }}
                </div>
            </div>
            <div class="extra content">
                <a :href="`https://github.com/${username}?tab=followers`">
                    <i class="user icon"></i>
                    @{{ user . followers }}Friends
                </a> 
            </div>
        </div> 
    </script>
    <!-- Import Vue.js and axios -->
    <script src="https://unpkg.com/vue"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script>
        Vue.component('github-user-card', {
            template: "#github-user-card-template",
            props: {
                username: {
                    type: String,
                    required: true,
                },
                koreanname: {
                    type: String,
                    required: true,
                }
            },
            data() {
                return {
                    user: {}
                }
            },
            created() {
                axios.get(`https://api.github.com/users/${this.username}`)
                    .then(response => {
                        this.user = response.data;
                    })
            }
        });
        new Vue({
            el: '#app',
            data: {
                students: [{
                        id: 'myspark02',
                        name: '?????????'
                    },
                    {
                        id: 'dongyeong1',
                        name: '?????????'
                    },
                    {
                        id: '1ncursio',
                        name: '?????????'
                    },
                    {
                        id: 'jungseKim',
                        name: '?????????'
                    },
                    {
                        id: 'aio39',
                        name: '?????????'
                    },
                    {
                        id: 'LeastKIds',
                        name: '?????????'
                    },
                    {
                        id: '34ruby',
                        name: '?????????'
                    },
                    {
                        id: 'lein-hub',
                        name: '?????????'
                    },
                    {
                        id: 'lizill',
                        name: '?????????'
                    },
                    {
                        id: 'sms217',
                        name: '?????????'
                    },
                    {
                        id: 'jae-yeal-Seo',
                        name: '?????????'
                    },
                    {
                        id: 'kimyeon99',
                        name: '?????????'
                    },
                    {
                        id: 'tjdrb63',
                        name: '?????????'
                    },
                    {
                        id: 'jja33705',
                        name: '?????????'
                    },
                    {
                        id: 'HyeonSeok-Jang',
                        name: '?????????'
                    },
                    {
                        id: 'MJoon-Jung',
                        name: '?????????'
                    },
                    {
                        id: 'Kassy',
                        name: '?????????'
                    },
                    {
                        id: 'agunacoco',
                        name: '?????????'
                    },
                    {
                        id: 'RiGun-K',
                        name: '?????????'
                    },
                    {
                        id: 'newstar0207',
                        name: '?????????'
                    },
                    {
                        id: 'suleun',
                        name: '?????????'
                    },
                    {
                        id: 'ChiKim22',
                        name: '?????????'
                    },
                    {
                        id: 'jhpdevs',
                        name: '?????????'
                    },
                    {
                        id: 'sksmsWKd',
                        name: '?????????'
                    },
                    {
                        id: 'YesYourShin',
                        name: '?????????'
                    },
                    {
                        id: 'InJoon-L',
                        name: '?????????'
                    },
                    {
                        id: 'JH0123',
                        name: '?????????'
                    },
                    {
                        id: 'q0103888',
                        name: '?????????'
                    },
                    {
                        id: 'Mirai1412',
                        name: '?????????'
                    },
                    {
                        id: 'JOWONCHAN',
                        name: '?????????'
                    },
                    {
                        id: 'SejunCheon',
                        name: '?????????'
                    },
                    {
                        id: 'choi-jiseong',
                        name: '?????????'
                    },
                    {
                        id: 'Kyumin-Han',
                        name: '?????????'
                    },
                    {
                        id: 'seon0522',
                        name: '?????????'
                    },
                    {
                        id: 'KRHDY',
                        name: '?????????'
                    },
                ]
            }
        })
    </script>
</body>

</html>
