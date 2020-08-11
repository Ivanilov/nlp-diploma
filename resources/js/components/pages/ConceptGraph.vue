<template>
    <fragment>
        <section class="hero is-warning">
            <div class="hero-body">
                <div class="container">
                    <h1 class="title">
                        Граф значений Microsoft
                    </h1>
                    <h2 class="subtitle">
                        Результатом ввода слова будет поиск значений, максимально приближенно описывающих слово с весами графа.
                    </h2>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="container is-fluid">
                <div class="box" v-if="result">
                    <h1 class="title">Значения:</h1>
                    <h2 class="subtitle">
                        <ul>
                            <li v-for="(key, value) in result">
                                {{ value }} - {{key}}
                            </li>
                        </ul>
                    </h2>
                </div>
                <div class="box">
                    <b-field
                        label="Слово для определения значений"
                        :type="error ? 'is-danger' : ''"
                        :message="error ? errorMessage : ''"
                    >
                        <b-input
                            type="text"
                            required
                            validation-message="Это поле обязательно для заполнения"
                            placeholder="Введите ваш слово в данное поле"
                            v-model="text"
                            :loading="loading"
                            :disabled="loading"
                        ></b-input>
                    </b-field>
                    <b-button type="is-warning" :disabled="!text" :loading="loading" @click="getConcept">
                        Определить значения
                    </b-button>
                </div>
            </div>
        </section>
    </fragment>
</template>
<script>
    import { getConceptGraph } from "../../api";

    export default {
        data() {
            return {
                loading:false,
                text:'',
                result:null,
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
                    text: this.text
                }
            },
            setResult(data) {
                this.result = data;
                console.log(data);
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
            getConcept() {
                let that = this;
                that.setLoading(true);
                getConceptGraph(
                    that.setDataToSend(),
                    (concept) => {
                        that.setLoading(false);
                        that.notify('Запрос успешно выполнен!', true);
                        that.setResult(concept.data.concept);
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
