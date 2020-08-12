<template>
    <fragment>
        <section class="hero is-primary">
            <div class="hero-body">
                <div class="container">
                    <h1 class="title">
                        Парсинг страницы по введенному url
                    </h1>
                    <h2 class="subtitle">
                       Определение авторов, мета-данных, текста из статьи
                    </h2>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="container is-fluid">
                <div class="box" v-if="result">
                    <h1 class="title">Результат:</h1>
                    <h2 class="subtitle">
                        {{ result }}
                    </h2>
                </div>
                <div class="box">
                    <b-field
                        label="Ссылка"
                        :type="error ? 'is-danger' : ''"
                        :message="error ? errorMessage : ''"
                    >
                        <b-input
                            type="text"
                            required
                            validation-message="Это поле обязательно для заполнения"
                            placeholder="Введите ваш текст в данное поле"
                            v-model="link"
                            :loading="loading"
                            :disabled="loading"
                        ></b-input>
                    </b-field>
                    <b-button type="is-primary" :disabled="!link" :loading="loading" @click="getArticleResult">
                        Обработать
                    </b-button>
                </div>
            </div>
        </section>
    </fragment>
</template>
<script>
    import { getArticle } from "../../api";

    export default {
        data() {
            return {
                loading:false,
                link:'',
                result:'',
                resultDetailed:'',
                error:false,
                errorMessage:''
            }
        },
        methods: {
            setLoading(state) {
                this.loading = state;
            },
            setError(state, message) {
                this.error = state;
                this.errorMessage = message;
            },
            setDataToSend() {
                return {
                    link: this.link
                }
            },
            setResult(data) {
                this.result = data;
            },
            notify(message, isSuccess) {
                this.$buefy.notification.open({
                    duration:5000,
                    message:message,
                    position:'is-top-right',
                    type:isSuccess ? 'is-success' : 'is-danger',
                    hasIcon:true
                });
            },
            getArticleResult() {
                let that = this;
                that.setLoading(true);
                getArticle(
                    that.setDataToSend(),
                    (article) => {
                        that.setLoading(false);
                        that.notify('Запрос успешно выполнен!', true);
                        that.setResult(article.data.article);
                    },
                    (error) => {
                        that.setLoading(false);
                        that.notify('Произошла ошибка!', false);
                        that.setResult('');
                        that.setError(true, error);
                    }
                )
            }
        }
    }
</script>
