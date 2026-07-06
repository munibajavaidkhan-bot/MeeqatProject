# Meeqat.io Enhanced Components Usage Guide

## Overview
This guide covers the modernized components and CSS enhancements in your Meeqat.io application.

---

## 🔘 Button Components

### Primary Button
The main call-to-action button with smooth animations.

```html
<a href="/calculator" class="btn btn-primary btn-lg">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m0 0h6"/>
    </svg>
    Start Calculator
</a>
```

**Features:**
- Smooth scale animations (1.02 on hover, 0.98 on active)
- Green glow shadow effect
- GPU-accelerated transforms
- Auto focus ring styling

### Secondary Button
For less prominent actions.

```html
<button class="btn btn-secondary btn-sm">
    Cancel
</button>
```

**Sizes:**
- `btn-sm`: Compact (36px height)
- `btn` (default): Standard (44px height)
- `btn-lg`: Large (52px height)

### Outline Button
For alternative actions.

```html
<button class="btn btn-outline">
    Learn More
</button>
```

### Danger Button
For destructive actions.

```html
<button class="btn btn-danger">
    Delete
</button>
```

### Ghost Button
For minimal visual impact.

```html
<button class="btn btn-ghost">
    More options
</button>
```

### Hero Button (Dark Background)
For hero sections.

```html
<a href="/duas" class="btn-hero-outline">
    Browse Duas
</a>
```

**Features:**
- Backdrop blur effect
- Better visibility on dark backgrounds
- Smooth glow on hover

---

## 💳 Card Components

### Standard Card
Basic card container for content.

```html
<div class="card">
    <div class="card-body">
        <h3 class="text-heading font-bold">Card Title</h3>
        <p class="text-muted">Card content goes here...</p>
    </div>
</div>
```

### Premium Glass Card
Modern glass-morphism style for important content.

```html
<div class="card-premium p-6">
    <h3 class="text-white font-bold">Premium Content</h3>
    <p class="text-dark-300">With glass effect...</p>
</div>
```

**Features:**
- 24px backdrop blur
- Semi-transparent background (rgba(255,255,255,0.08))
- Better on hover (0.12 opacity)
- Premium shadow effects

### Card Hover
Card with lift animation on hover.

```html
<div class="card-hover">
    <div class="card-body">
        <h3>Hoverable Card</h3>
    </div>
</div>
```

### Card with Header/Footer
Structured card layout.

```html
<div class="card">
    <div class="card-header">
        <h3>Header Title</h3>
    </div>
    <div class="card-body">
        Content here
    </div>
    <div class="card-footer">
        Footer action
    </div>
</div>
```

---

## 📋 Form Components

### Input Field
Enhanced input with better focus states.

```html
<div class="mb-5">
    <label class="form-label">Email Address</label>
    <input 
        type="email" 
        class="form-input" 
        placeholder="your@email.com"
        required>
    <p class="form-hint">We'll never share your email</p>
</div>
```

**Features:**
- Shadow-sm by default
- Shadow-md on focus
- Smooth color transitions
- Better focus ring styling

### Form Label
For proper form structure.

```html
<label class="form-label">
    Full Name <span class="text-red-500">*</span>
</label>
```

### Form Error
Display validation errors.

```html
<p class="form-error">
    <svg class="w-4 h-4"><!-- error icon --></svg>
    Email is required
</p>
```

### Form Hint
Helpful text below inputs.

```html
<p class="form-hint">Password must be at least 8 characters</p>
```

### Select Field
Dropdown input.

```html
<select class="form-select">
    <option>Select an option</option>
    <option>Option 1</option>
</select>
```

### Textarea
Multi-line input.

```html
<textarea class="form-textarea" placeholder="Your message..."></textarea>
```

---

## 🎯 Navigation Components

### Navigation Link
Main navigation links.

```html
<a href="/home" class="nav-link">
    Home
</a>

<!-- Active state -->
<a href="/about" class="nav-link nav-link-active">
    About
</a>
```

### Dropdown Menu
With smooth animations.

```html
<div class="dropdown-menu">
    <a href="#" class="dropdown-item">
        <svg><!-- icon --></svg>
        <div>
            <p class="font-semibold">Option Title</p>
            <p class="text-caption text-muted">Subtitle</p>
        </div>
    </a>
    <div class="dropdown-divider"></div>
    <a href="#" class="dropdown-item">Another Option</a>
</div>
```

---

## 📊 Dashboard Components

### Stat Card (Glass)
Premium stat display.

```html
<div class="card-premium overflow-hidden group">
    <div class="p-6 flex flex-col h-full relative">
        <div class="flex items-start justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-dark-700/50 flex items-center justify-center">
                📊
            </div>
            <span class="badge-green">LIVE</span>
        </div>
        <p class="text-3xl font-black text-white mb-2">1,234</p>
        <p class="text-dark-400 text-sm font-semibold">Total Users</p>
    </div>
</div>
```

**Features:**
- Smooth hover animations
- Badge indicators
- Better spacing
- Glass effect background

### Table (Modern)
Enhanced table styling.

```html
<table class="w-full">
    <thead>
        <tr class="border-b border-dark-700/30">
            <th class="px-6 py-3 text-left text-caption font-semibold text-dark-400">
                Column Header
            </th>
        </tr>
    </thead>
    <tbody>
        <tr class="border-b border-dark-700/20 hover:bg-dark-700/20 transition-colors">
            <td class="px-6 py-3">Data</td>
        </tr>
    </tbody>
</table>
```

### Badge
Status indicators.

```html
<span class="badge-green">Active</span>
<span class="badge-amber">Pending</span>
<span class="badge-red">Inactive</span>
<span class="badge-blue">Info</span>
<span class="badge-gold">Premium</span>
<span class="badge-purple">Custom</span>
<span class="badge-pink">Highlight</span>
<span class="badge-gray">Neutral</span>
```

---

## 🎨 Animation Classes

### Slide Up
For entrance animations.

```html
<div class="animate-slide-up" style="animation-delay: 0.1s">
    Content slides up on load
</div>
```

### Fade In
Simple fade effect.

```html
<div class="animate-fade-in">
    Content fades in
</div>
```

### Pulse Slow
Subtle pulsing for attention.

```html
<span class="animate-pulse-slow">
    🟢 Live
</span>
```

### Float
Gentle floating motion.

```html
<div class="animate-float">
    Floats up and down
</div>
```

### Shimmer
Loading skeleton effect.

```html
<div class="animate-shimmer h-12 bg-dark-700 rounded-lg"></div>
```

---

## 🌈 Shadow Utilities

### Basic Shadows
```html
<!-- Light shadows -->
<div class="shadow-sm">Subtle shadow</div>
<div class="shadow-md">Medium shadow</div>
<div class="shadow-lg">Large shadow</div>
<div class="shadow-xl">Extra large shadow</div>
<div class="shadow-elevated">Maximum depth</div>
```

### Glow Shadows
```html
<!-- Color-specific glows -->
<button class="shadow-glow-green">Green glow</button>
<button class="shadow-glow-red">Red glow</button>
```

---

## 🔍 Glass Effects

### Standard Glass
For light backgrounds.

```html
<div class="glass p-4">
    Frosted glass effect
</div>
```

### Dark Glass
For dark backgrounds.

```html
<div class="glass-dark p-4">
    Dark frosted glass
</div>
```

---

## 🎬 Backdrop Effects

### Blur Levels
```html
<!-- Different blur amounts -->
<div class="backdrop-blur-xs">Very subtle blur</div>
<div class="backdrop-blur-sm">Light blur</div>
<div class="backdrop-blur-md">Medium blur (default)</div>
<div class="backdrop-blur-lg">Strong blur</div>
```

---

## 📱 Responsive Utilities

### Responsive Classes
Combine with standard Tailwind prefixes.

```html
<!-- Different on mobile vs desktop -->
<div class="text-sm md:text-base lg:text-lg">
    Responsive text
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
    Responsive grid
</div>
```

---

## 🎨 Color System

### Primary Colors
Used for main actions and highlights.

```html
<div class="text-primary-500">Primary text</div>
<div class="bg-primary-50">Light background</div>
<div class="border-primary-200">Subtle border</div>
```

### Secondary (Gold) Colors
For accents and alternatives.

```html
<div class="text-secondary-600">Gold accent</div>
<div class="badge-gold">Gold badge</div>
```

### Status Colors
For indicating state.

```html
<!-- Success -->
<span class="text-green-500">✓ Active</span>

<!-- Error -->
<span class="text-red-600">✗ Error</span>

<!-- Warning -->
<span class="text-secondary-600">⚠ Warning</span>

<!-- Info -->
<span class="text-blue-500">ℹ Info</span>
```

---

## 💡 Best Practices

### Accessibility
- Always include proper `aria-labels`
- Use semantic HTML elements
- Ensure sufficient color contrast
- Provide focus states

### Performance
- Use `transform-gpu` for animations
- Minimize repaints with transitions
- Use `will-change` for critical animations
- Optimize image sizes

### Consistency
- Use predefined spacing (p-6, gap-4, etc.)
- Follow color palette guidelines
- Maintain animation durations (200-300ms)
- Use consistent shadow levels

### Mobile First
- Build for mobile first
- Use responsive prefixes (md:, lg:)
- Test on various screen sizes
- Ensure touch-friendly sizes (min 44px buttons)

---

## 🔧 Customization

### Extending Colors
Update in your Tailwind config:

```js
theme: {
    colors: {
        primary: { ... },
        secondary: { ... },
    }
}
```

### Custom Animations
Add to your CSS:

```css
@keyframes custom {
    0% { /* ... */ }
    100% { /* ... */ }
}

.animate-custom {
    animation: custom 1s ease-out;
}
```

### Button Variants
Create new button styles:

```css
.btn-success {
    @apply btn bg-green-500 text-white
           hover:bg-green-600
           focus-visible:ring-green-500;
}
```

---

## 📚 Resources

- **Tailwind CSS**: https://tailwindcss.com
- **CSS Animations**: https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_Animations
- **Accessibility**: https://www.a11y-101.com/

---

## 🚀 Final Notes

All components are:
- ✅ Fully responsive
- ✅ Accessible (WCAG 2.1)
- ✅ GPU-accelerated
- ✅ Mobile-friendly
- ✅ Dark mode compatible
- ✅ SEO optimized

Use these components as building blocks for consistent, professional UI across your application!
