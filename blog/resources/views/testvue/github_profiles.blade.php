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
                        name: '박성철'
                    },
                    {
                        id: 'dongyeong1',
                        name: '김동영'
                    },
                    {
                        id: '1ncursio',
                        name: '김예찬'
                    },
                    {
                        id: 'jungseKim',
                        name: '김정세'
                    },
                    {
                        id: 'aio39',
                        name: '김진섭'
                    },
                    {
                        id: 'LeastKIds',
                        name: '김진홍'
                    },
                    {
                        id: '34ruby',
                        name: '박규진'
                    },
                    {
                        id: 'lein-hub',
                        name: '박동재'
                    },
                    {
                        id: 'lizill',
                        name: '박동현'
                    },
                    {
                        id: 'sms217',
                        name: '서민성'
                    },
                    {
                        id: 'jae-yeal-Seo',
                        name: '서재열'
                    },
                    {
                        id: 'kimyeon99',
                        name: '예승재'
                    },
                    {
                        id: 'tjdrb63',
                        name: '장성규'
                    },
                    {
                        id: 'jja33705',
                        name: '장재현'
                    },
                    {
                        id: 'HyeonSeok-Jang',
                        name: '장현석'
                    },
                    {
                        id: 'MJoon-Jung',
                        name: '정명준'
                    },
                    {
                        id: 'Kassy',
                        name: '황현종'
                    },
                    {
                        id: 'agunacoco',
                        name: '구나현'
                    },
                    {
                        id: 'RiGun-K',
                        name: '김리건'
                    },
                    {
                        id: 'newstar0207',
                        name: '김새별'
                    },
                    {
                        id: 'suleun',
                        name: '김소은'
                    },
                    {
                        id: 'ChiKim22',
                        name: '김진호'
                    },
                    {
                        id: 'jhpdevs',
                        name: '박주형'
                    },
                    {
                        id: 'sksmsWKd',
                        name: '송재현'
                    },
                    {
                        id: 'YesYourShin',
                        name: '신동훈'
                    },
                    {
                        id: 'InJoon-L',
                        name: '이인준'
                    },
                    {
                        id: 'JH0123',
                        name: '이주현'
                    },
                    {
                        id: 'q0103888',
                        name: '이현호'
                    },
                    {
                        id: 'Mirai1412',
                        name: '임채환'
                    },
                    {
                        id: 'JOWONCHAN',
                        name: '조원찬'
                    },
                    {
                        id: 'SejunCheon',
                        name: '천세준'
                    },
                    {
                        id: 'choi-jiseong',
                        name: '최지성'
                    },
                    {
                        id: 'Kyumin-Han',
                        name: '한규민'
                    },
                    {
                        id: 'seon0522',
                        name: '허효선'
                    },
                    {
                        id: 'KRHDY',
                        name: '황대영'
                    },
                ]
            }
        })
    </script>
</body>

</html>
