// tests/Unit/frontend/TicketGeneration.spec.mjs

import { shallowMount } from '@vue/test-utils';
import TicketGeneration from '@/components/TicketGeneration.vue';  // Adjust the path

describe('TicketGeneration.vue', () => {
  let wrapper;

  beforeEach(() => {
    wrapper = shallowMount(TicketGeneration);
  });

  it('renders ticket generation section', () => {
    expect(wrapper.find('h2').text()).toBe('Ticket Generation');
    expect(wrapper.find('.ticket-button').exists()).toBe(true);
  });

  it('displays correct ticket generation date', () => {
    const date = wrapper.find('.ticket-start-date');
    expect(date.exists()).toBe(true);
    expect(date.text()).toContain('Start Date');
  });

  it('generates ticket when button clicked', async () => {
    const button = wrapper.find('.ticket-button');
    await button.trigger('click');
    // Simulate ticket generation action
    expect(wrapper.emitted().generateTicket).toBeTruthy();
  });
});
