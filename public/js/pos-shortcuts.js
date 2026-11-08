document.addEventListener('keydown', function(event) {
    // ১. Alt + S অথবা F2 চাপলে প্রোডাক্ট সার্চ ফিল্ডে ফোকাস হবে
    if ((event.altKey && (event.key === 's' || event.key === 'S')) || event.key === 'F2') {
        event.preventDefault(); // ব্রাউজারের ডিফল্ট শর্টকাট অ্যাকশন বন্ধ করার জন্য
        
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.focus();  // সার্চ বক্সে কার্সার নিয়ে যাবে
            searchInput.select(); // যদি আগে কিছু লেখা থাকে তা সিলেক্ট করে নেবে
        }
    }
});

document.addEventListener('keydown', function(event) {
    // উদাহরণ: Alt + F চাপলে চেকবক্সটি টগল হবে
    if (event.altKey && (event.key === 'f' || event.key === 'F')) {
        event.preventDefault(); // ব্রাউজারের ডিফল্ট আচরণ বন্ধ করার জন্য
        
        const checkbox = document.getElementById('fullPaid');
        if (checkbox) {
            checkbox.checked = !checkbox.checked; // স্টেট পরিবর্তন (Checked <-> Unchecked)
            
            // যদি আপনার চেকবক্সে কোনো 'change' ইভেন্ট হ্যান্ডলার থাকে, তবে তা ট্রিগার করার জন্য:
            checkbox.dispatchEvent(new Event('change'));
        }
    }
});

    // Select the discount input field when Alt + D is pressed
document.addEventListener('keydown', function(event) {
    // Alt + D চাপলে Discount ফিল্ডে কার্সার (Focus) যাবে
    if (event.altKey && (event.key === 'd' || event.key === 'D')) {
        event.preventDefault(); // ব্রাউজারের ডিফল্ট শর্টকাট অ্যাকশন বন্ধ রাখার জন্য
        
        const discountInput = document.getElementById('discount');
        if (discountInput) {
            discountInput.focus();  // ইনপুট বক্সে কার্সার নিয়ে আসবে
            discountInput.select(); // ফিল্ডের বর্তমান মানটি সিলেক্ট করবে যাতে সরাসরি টাইপ করা যায়
        }
    }
});

   // sale completion shortcut: Ctrl + Enter or F10
document.addEventListener('keydown', function(event) {
    // Ctrl + Enter অথবা F10 চাপলে সেল সেভ বা কমপ্লিট হবে
    if ((event.ctrlKey && event.key === 'Enter') || event.key === 'F10') {
        event.preventDefault(); // ব্রাউজারের ডিফল্ট শর্টকাট অ্যাকশন বন্ধ করার জন্য
        
        const saveButton = document.getElementById('completeSaleBtn');
        if (saveButton) {
            saveButton.click(); // সরাসরি বাটনে ক্লিকের কাজ করবে
        }
    }
});