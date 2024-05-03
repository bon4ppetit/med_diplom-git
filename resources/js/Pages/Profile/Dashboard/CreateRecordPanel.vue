<script setup>
    import VueDatePicker from '@vuepic/vue-datepicker';
    import '@vuepic/vue-datepicker/dist/main.css';

    import {ref} from "vue";

    let doctors = ref([]);
    let idDoctorListTime = ref(0);
    let listWorkingTime = ref([]);
    let selectedDoctor = ref();
    let currentDate =  new Date().toISOString().split('T')[0];
    let professionDoctors = ref();
    let maxSelectedDate =  currentDate.substring(0, 5) + `0${(+currentDate.split('-')[1] + 1)}` + currentDate.substring(7);
    const formatter = ref({
        date: 'DD-MM-YYYY',
        month: 'MMM',
    })
    let record = {
        doctor_id: 0,
        record_datetime: null
    }
    let viewFilterDoctors = ref();
    let listFilterDoctors = [];

    function selectDoctor(id) {
        record.doctor_id = id
        selectedDoctor.value = id
    }

    function createRecord() {
        axios.post(route('create-record'), record)
            .then((res) => {
                location.reload();
            })
            .catch(() => {
                console.log('error')
            })
    }

    function viewListTime(dateAndTime, doctorId, selectedDay) {
        idDoctorListTime.value = doctorId;
        listWorkingTime.value = dateAndTime[selectedDay];
    }

    function getProfessionDoctors() {
        axios.get(route('get-professions'))
            .then((res) => {
                professionDoctors.value = res.data;
            })
    }
    getProfessionDoctors();

    function filterList(idProfession) {
        listFilterDoctors = []

        if (idProfession === 'all') {
            viewFilterDoctors.value = doctors.value;
            return;
        }

        doctors.value.forEach((x) => {
            if (x.profession_id === idProfession) {
                listFilterDoctors.push(x)
            }
        })
        viewFilterDoctors.value = listFilterDoctors
    }

    function getAllDoctors() {
        axios.get(route('get-all-doctors'))
            .then((res) => {
                console.log(res.data)
                doctors.value = viewFilterDoctors.value = res.data

            })
    }
    getAllDoctors()
</script>

<template>
    <div class="min-h-[100vh] p-6">
        <h1 class="text-xl mb-3">
            Записаться к врачу
        </h1>
        <div class="mb-3 min-h-full">
            <h2>
                Какого врача нужно посетить?
            </h2>
            <div class="list_professions p-2 flex gap-2 overflow-y-scroll">
                <button v-for="item in professionDoctors" v-on:click="filterList(item.id)" :id="item.id" class="list_professions-button hover:shadow-xl transition-all duration-300 border-2 py-2 rounded-[5px] px-3 max-w-[200px]">
                    {{ item.name }}
                </button>
                <button v-on:click="filterList('all')" class="hover:shadow-xl transition-all duration-300 border-2 py-2 rounded-[5px] px-3 max-w-[200px]">
                    Все врачи
                </button>
            </div>
            <div class="p-3 flex flex-col max-w-[400px] m-auto gap-4 justify-center">
                <div v-for="doctor in viewFilterDoctors" class="p-2 border-2" :id="'selected_doctor-' + doctor.user_id" >
                    <div class="doctor_info-block flex justify-center items-center mb-[20px]">
                        <div class="doctor_img-block mr-4">
                            <img class="doctor_img max-w-[200px] h-[200px] rounded-[4px]" :src="'/storage/doctors_photo/' + doctor.avatar_photo + '.jpg'">
                        </div>
                        <div>
                            <div class="mb-1">
                                {{doctor.surname + ' ' + doctor.name + ' ' + doctor.patronymic}}
                            </div>
                            <div class="mb-1">
                            <span class="text-gray-400">
                                Специализация:
                            </span>
                                <span>
                                {{doctor.profession}}
                            </span>
                            </div>
                            <div class="mb-1">
                            <span class="text-gray-400">
                                Кабинет:
                            </span>
                                <span>
                            {{doctor.number_room}}
                            </span>
                            </div>
                            <div>
                            <span class="text-gray-400">
                                Время работы:
                            </span>
                                <div class="flex">
                                    <div class="mr-6">
                                        <span>От  </span>
                                        <span>{{doctor.working_time_start}}</span>
                                    </div>
                                    <div>
                                        <span>До  </span>
                                        <span>{{doctor.working_time_end}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="mb-[5px]">Укажите дату и время</div>
                        <VueDatePicker v-model="record.record_datetime" :max-date="maxSelectedDate" :min-date="currentDate"></VueDatePicker>
                    </div>
                    <div class="w-full mt-3 flex justify-end">
                        <button v-if="selectedDoctor === doctor.user_id" class="bg-green-700 px-3 py-2 text-white rounded-[10px]">
                            Выбран
                        </button>
                        <button v-else class="bg-blue-700 px-3 py-2 text-white rounded-[10px]" v-on:click="selectDoctor(doctor.user_id)">
                            Выбрать
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <button class="bg-blue-700 px-5 py-3 text-white rounded-[10px]" v-on:click="createRecord()">Записаться</button>
        </div>
    </div>
</template>

<style scoped>
@media (max-width: 418px) {
    .doctor_info-block {
        flex-direction: column;
    }
    .list_professions-button {
        height: 50px;
    }
}
</style>
