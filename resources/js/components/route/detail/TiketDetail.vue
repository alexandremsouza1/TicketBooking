<template>
    <div>
        <baner-component></baner-component>
        <main id="tg-main" class="tg-main tg-haslayout">
            <div v-if="ticket && ticket.bus_route" class="container component-booking">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div id="tg-content" class="tg-content">
                            <div class="tg-tourbookingdetail">
                                <div class="tg-bookinginfo tg-formtheme tg-formbillingdetail">
                                    <div class="col-md-5 block-info">
                                        <div class="tg-bookingdetail">
                                            <div class="tg-box tg-yourorder">
                                                <div class="tg-heading">
                                                    <h3>{{ $t('route.your_info') }}</h3>
                                                </div>
                                                <div class="tg-widgetpersonprice">
                                                    <div class="tg-widgetcontent">
                                                        <ul>
                                                            <li class="tg-personprice">
                                                                <div>
                                                                    <span>{{ $t('route.name') }}:</span><em>{{ ticket.name }}</em><br><br>
                                                                    <span>{{ $t('route.phone') }}:</span><em>{{ ticket.phone }}</em><br><br>
                                                                    <span>{{ $t('profile.email') }}:</span><em>{{ ticket.email }}</em>
                                                                </div>
                                                            </li>
                                                            <li><span>{{ $t('route.company') }}:</span><em>{{ ticket.bus_route.route.company_name }}</em></li>
                                                            <li>
                                                                <span>{{ $t('company.route') }}:</span>
                                                                <em>{{ ticket.bus_route.route.start_station_name }}</em>
                                                                <em>=> {{ ticket.bus_route.route.destination_station_name }}</em>
                                                            </li>
                                                            <li><span>{{ $t('route.start_place') }}:</span><em>{{ ticket.start_place ? ticket.start_place : ticket.bus_route.route.start_station.address }}</em></li>
                                                            <li><span>{{ $t('route.destination_place') }}:</span><em>{{ ticket.destination_place ? ticket.destination_place : ticket.bus_route.route.destination_station.address }}</em></li>
                                                            <li><span>{{ $t('company.start_time') }}:</span><em>{{ ticket.bus_route.route.start_time }} - {{ ticket.date }}</em></li>
                                                            <li>
                                                                <span>{{ $t('route.number_of_seats') }}:</span>
                                                                <template v-if="JSON.parse(ticket.seat_number).length">
                                                                    <em>{{ JSON.parse(ticket.seat_number).length }}
                                                                    ( <template v-for="(seat, index) in JSON.parse(ticket.seat_number)">
                                                                        <label class="label label-info" :key="index">{{ seat }}</label>&nbsp;
                                                                    </template>)</em>
                                                                </template>
                                                                <template v-else>
                                                                    <em>{{ ticket.quantity }}</em>
                                                                </template>
                                                            </li>
                                                            <li><span>{{ $t('route.ticket_price') }}:</span><em>{{ Number(ticket.bus_route.price).toLocaleString() }}đ</em></li>
                                                            <li class="tg-totalprice">
                                                                <div v-if="JSON.parse(ticket.seat_number).length" class="tg-totalpayment"><span>{{ $t('route.total') }}</span><em> {{ Number(ticket.total_price).toLocaleString() }}đ</em></div>
                                                                <div v-else class="tg-totalpayment"><span>{{ $t('route.total') }}</span><em> {{ Number(ticket.total_price).toLocaleString() }}đ</em></div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7 block-checkout">
                                        <div class="tg-bookingdetail">
                                            <fieldset class="tg-paymentarea">
                                                <div class="tg-heading">
                                                    <h3>{{ $t('route.pay_method') }}</h3>
                                                </div>
                                                <div id="tg-accordion" class="tg-accordion" role="tablist" aria-multiselectable="true">
                                                    <div v-if="ticket.bus_route.route.direct_payment == directPayment.allow" class="tg-panel">
                                                        <h4 class="tg-radio">
                                                            <input disabled type="radio" v-model="paymentMethod" :value="paymentMethodSetting.direct" id="bank-transfer" name="paymenttype">
                                                            <label for="bank-transfer">Direct Bank Transfer</label>
                                                        </h4>
                                                        <!-- <div class="tg-panelcontent">
                                                            <div class="tg-description">
                                                                <p>Trực tiếp thanh toán với nhà xe khi lên xe</p>
                                                            </div>
                                                        </div> -->
                                                    </div>
                                                    <div class="tg-panel">
                                                        <h4 class="tg-radio">
                                                            <input disabled type="radio" v-model="paymentMethod" :value="paymentMethodSetting.paypal" id="paypal" name="paymenttype">
                                                            <label for="paypal">PayPal Express Checkout </label>
                                                            <img src="images/paypal.jpg" alt="image description">
                                                        </h4>
                                                        <!-- <div class="tg-panelcontent">
                                                            <div class="tg-description">
                                                                <p>Maecenas sed diam eget risus varius blandit sit amet non magna. Vivamus sagittis lacus vel augue Sed non mauris vitae;erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo.</p>
                                                            </div>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
    import { mapActions, mapState } from 'vuex'
    import Banner from '@plugins/Banner.vue'

    export default {
        data: function() {
            return {
                directPayment: window.Laravel.setting.direct_payment,
                paymentMethodSetting: window.Laravel.setting.ticket.payment_method
            }
        },
        computed: {
            ...mapState('ticket', ['ticket']),
            paymentMethod: function() {
                return this.ticket.payment_method;
            }
        },
        created() {
            this.setTicket(this.$route.params.id)
                .catch(error => {
                    this.$router.push({
                        name: '404'
                    })
                });
        },
        watch: {
            '$route' (to, from) {
                this.setTicket(this.$route.params.id);
            },
        },
        components: {
            banerComponent: Banner
        },
        methods: {
            ...mapActions('ticket', ['setTicket'])
        },
        updated() {
            jQuery(function() {
                jQuery('.tg-panelcontent').hide();
                jQuery('.tg-accordion h4:first').addClass('active').next().slideDown('slow');
                jQuery('.tg-accordion h4').on('click',function() {
                    if(jQuery(this).next().is(':hidden')) {
                        jQuery('.tg-accordion h4').removeClass('active').next().slideUp('slow');
                        jQuery(this).toggleClass('active').next().slideDown('slow');
                    }
                });
            });
        }
    }
</script>

<style scoped>
    .panel-body {
        text-align: left;
        font-size: 13px;
        background: #f2faff;
    }

    .panel.panel-info .panel-body .col-xs-8 {
        font-weight: bold;
        color: #333;
    }

    .panel.panel-info .panel-body .col-xs-4 {
        color: #fa7550;
    }

    .tg-widgetcontent ul li span {
        color: #333;
        font-size: 14px;
    }

    .tg-widgetcontent ul li em {
        font-size: 14px;
    }

    .row.alert.alert-danger {
        margin-bottom: -15px !important;
        margin-top: 15px;
        border-right: unset;
        border-bottom: unset;
        border-left: unset;
        border-radius: unset;
    }

    .tg-bookinginfo {
        padding-top: 50px;
        padding-bottom: 50px;
        margin-bottom: 100px;
    }
    
    .tg-bookinginfo .block-checkout {
        float: left;
        padding: 0 30px 0 15px;
        border-right: 1px solid #e6e6e6;
    }
    
    .tg-bookinginfo .block-info {
        float: right;
        padding: 0 15px 0 30px;
    }

    .tg-bookingdetail {
        width: 100%;
        border-right: unset;
        padding: 0px;
    }

    .tg-heading {
        margin-bottom: 10px;
    }

    .tg-widgetcontent ul li + li {
        padding: 15px 0 0;
    }

    .tg-formtheme .tg-paymentarea {
        margin-top: 0px;
    }

    .tg-heading h3 {
        float: left;
    }

    em {
        width: 64%;
        text-align: right;
    }
</style>
