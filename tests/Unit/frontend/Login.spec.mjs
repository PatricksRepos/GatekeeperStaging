// tests/Unit/frontend/Login.spec.mjs

import { shallowMount } from '@vue/test-utils';
import Login from '@/components/Login.vue';  // Adjust the path based on your project structure

describe('Login.vue', () => {
  let wrapper;

  beforeEach(() => {
    wrapper = shallowMount(Login);
  });

  it('renders login form correctly', () => {
    expect(wrapper.find('input[type="email"]').exists()).toBe(true);
    expect(wrapper.find('input[type="password"]').exists()).toBe(true);
    expect(wrapper.find('button[type="submit"]').text()).toBe('Log In');
  });

  it('validates email input', async () => {
    const emailInput = wrapper.find('input[type="email"]');
    await emailInput.setValue('');
    await wrapper.find('form').trigger('submit.prevent');
    expect(wrapper.text()).toContain('Email is required');
  });

  it('validates password input', async () => {
    const passwordInput = wrapper.find('input[type="password"]');
    await passwordInput.setValue('');
    await wrapper.find('form').trigger('submit.prevent');
    expect(wrapper.text()).toContain('Password is required');
  });

  it('submits form when valid', async () => {
    const emailInput = wrapper.find('input[type="email"]');
    const passwordInput = wrapper.find('input[type="password"]');
    await emailInput.setValue('test@example.com');
    await passwordInput.setValue('password123');

    await wrapper.find('form').trigger('submit.prevent');

    // Assuming there's some method to handle submission
    expect(wrapper.emitted().submit).toBeTruthy();
  });
});
