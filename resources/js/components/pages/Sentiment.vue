<template>
    <fragment>
        <section class="hero is-danger">
            <div class="hero-body">
                <div class="container">
                    <h1 class="title">
                        Определение тональности текста
                    </h1>
                    <h2 class="subtitle">
                        Определение, какой "эмоциональный посыл" несет введенный текст
                    </h2>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="container is-fluid">
                <div class="box" v-if="result != null">
                    <h1 class="title">Тональность: "{{resultText}}"</h1>
                    <img class="sentiment-result-image" :src="'/images/sentiment_'+result+'.png'" alt="">
                </div>
                <div class="box">
                    <b-field
                        label="Текст для определения тональности"
                        :type="error ? 'is-danger' : ''"
                        :message="error ? errorMessage : ''"
                    >
                        <b-input
                            type="textarea"
                            required
                            validation-message="Это поле обязательно для заполнения"
                            placeholder="Введите ваш текст в данное поле"
                            v-model="text"
                            :loading="loading"
                            :disabled="loading"
                        ></b-input>
                    </b-field>
                    <div class="block">
                        <b-radio v-model="language"
                                 name="name"
                                 size="is-medium"
                                 type="is-danger"
                                 native-value="en">
                            English
                        </b-radio>
                        <b-radio v-model="language"
                                 name="name"
                                 size="is-medium"
                                 type="is-danger"
                                 native-value="ru">
                            Русский
                        </b-radio>
                        <b-radio v-model="language"
                                 name="name"
                                 size="is-medium"
                                 type="is-danger"
                                 native-value="uk">
                            Українська
                        </b-radio>
                    </div>
                    <b-button type="is-danger" :disabled="!text || !language" :loading="loading" @click="getSentimentResult">
                        Узнать тональность
                    </b-button>
                </div>
            </div>
        </section>
    </fragment>
</template>
<script>
    import { getSentiment } from "../../api";

    export default {
        data() {
            return {
                loading:false,
                text:'',
                language:'',
                result:null,
                error:false,
                errorMessage:'',
                resultText:''
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
                    text: this.text,
                    language: this.language
                }
            },
            setResult(data) {
                this.result = data;
                if(data === 1)
                    this.resultText = 'Хорошо';
                else if(data === 0)
                    this.resultText = 'Нейтрально';
                else
                    this.resultText = 'Плохо';
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
            getSentimentResult() {
                let that = this;
                that.setLoading(true);
                getSentiment(
                    that.setDataToSend(),
                    (sentiment) => {
                        that.setLoading(false);
                        that.notify('Запрос успешно выполнен!', true);
                        that.setResult(sentiment.data.sentiment);
                    },
                    (error) => {
                        that.setLoading(false);
                        that.notify('Произошла ошибка!', false);
                        that.setResult('');
                        that.setError(true, error);
                    }
                )
            },
        }
    }
</script>
<style scoped>
    .sentiment-result-image {
        width:10%;
    }
</style>
