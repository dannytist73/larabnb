import { computed, isRef } from "vue";

export const useMonthlyPayment = (total, interestRate, duration) => {
    const refTotal = computed(() => (isRef(total) ? total.value : total));
    const refInterest = computed(() =>
        isRef(interestRate) ? interestRate.value : interestRate
    );
    const refDuration = computed(() =>
        isRef(duration) ? duration.value : duration
    );

    const monthlyPayment = computed(() => {
        const principal = refTotal.value;
        const monthlyInterest = refInterest.value / 100 / 12;
        const numberOfPaymentMonths = refDuration.value * 12;

        return (
            (principal *
                monthlyInterest *
                Math.pow(1 + monthlyInterest, numberOfPaymentMonths)) /
            (Math.pow(1 + monthlyInterest, numberOfPaymentMonths) - 1)
        );
    });

    const totalPaid = computed(() => {
        return refDuration.value * 12 * monthlyPayment.value;
    });

    const totalInterest = computed(() => totalPaid.value - refTotal.value);

    return { monthlyPayment, totalPaid, totalInterest };
};
