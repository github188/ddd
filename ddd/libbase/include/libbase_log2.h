/* Integer base 2 logarithm calculation
 *
 * Copyright (C) 2006 Red Hat, Inc. All Rights Reserved.
 * Written by David Howells (dhowells@redhat.com)
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version
 * 2 of the License, or (at your option) any later version.
 */

#ifndef _LINUX_LOG2_H
#define _LINUX_LOG2_H

#include <stdint.h>

/**
 * fls - find last (most-significant) bit set
 * @x: the word to search
 *
 * This is defined the same way as ffs.
 * Note fls(0) = 0, fls(1) = 1, fls(0x80000000) = 32.
 */

static inline int fls(int x)
{
    int r = 32;

    if (!x)
        return 0;
    if (!(x & 0xffff0000u)) {
        x <<= 16;
        r -= 16;
    }
    if (!(x & 0xff000000u)) {
        x <<= 8;
        r -= 8;
    }
    if (!(x & 0xf0000000u)) {
        x <<= 4;
        r -= 4;
    }
    if (!(x & 0xc0000000u)) {
        x <<= 2;
        r -= 2;
    }
    if (!(x & 0x80000000u)) {
        x <<= 1;
        r -= 1;
    }
    return r;
}

/**
 * fls64 - find last set bit in a 64-bit word
 * @x: the word to search
 *
 * This is defined in a similar way as the libc and compiler builtin
 * ffsll, but returns the position of the most significant set bit.
 *
 * fls64(value) returns 0 if value is 0 or the position of the last
 * set bit if value is nonzero. The last (most significant) bit is
 * at position 64.
 */
# if __WORDSIZE == 64
/*
 * __fls: find last set bit in word
 * @word: The word to search
 *
 * Undefined if no set bit exists, so code should check against 0 first.
 */
static inline unsigned long __fls(unsigned long word)
{
    asm("bsr %1,%0"
            : "=r" (word)
            : "rm" (word));
    return word;
}

static inline int fls64(uint64_t x)
{
    if (x == 0)
        return 0;
    return __fls(x) + 1;
}
#else
static inline int fls64(uint64_t x)
{
    uint32_t h = x >> 32;
    if (h)
        return fls(h) + 32;
    return fls(x);
}
#endif

static inline unsigned fls_long(unsigned long l)
{
    if (sizeof(l) == 4)
        return fls(l);
    return fls64(l);
}

/*
 * deal with unrepresentable constant logarithms
 */
extern __attribute__((const, noreturn))
int ____ilog2_NaN(void);

/*
 * non-constant log of base 2 calculators
 * - the arch may override these in asm/bitops.h if they can be implemented
 *   more efficiently than using fls() and fls64()
 * - the arch is not required to handle n==0 if implementing the fallback
 */
#ifndef CONFIG_ARCH_HAS_ILOG2_U32
static inline __attribute__((const))
int __ilog2_u32(uint32_t n)
{
    return fls(n) - 1;
}
#endif

#ifndef CONFIG_ARCH_HAS_ILOG2_U64
static inline __attribute__((const))
int __ilog2_u64(uint64_t n)
{
    return fls64(n) - 1;
}
#endif

/*
 *  Determine whether some value is a power of two, where zero is
 * *not* considered a power of two.
 */

static inline __attribute__((const))
int is_power_of_2(unsigned long n)
{
    return (n != 0 && ((n & (n - 1)) == 0));
}

/*
 * round up to nearest power of two
 */
static inline __attribute__((const))
unsigned long __roundup_pow_of_two(unsigned long n)
{
    return 1UL << fls_long(n - 1);
}

/*
 * round down to nearest power of two
 */
static inline __attribute__((const))
unsigned long __rounddown_pow_of_two(unsigned long n)
{
    return 1UL << (fls_long(n) - 1);
}

/**
 * ilog2 - log of base 2 of 32-bit or a 64-bit unsigned value
 * @n - parameter
 *
 * constant-capable log of base 2 calculation
 * - this can be used to initialise global variables from constant data, hence
 *   the massive ternary operator construction
 *
 * selects the appropriately-sized optimised version depending on sizeof(n)
 */
#define ilog2(n) \
    ( \
        __builtin_constant_p(n) ? ( \
        (n) < 1 ? ____ilog2_NaN() : \
        (n) & (1ULL << 63) ? 63 : \
        (n) & (1ULL << 62) ? 62 : \
        (n) & (1ULL << 61) ? 61 : \
        (n) & (1ULL << 60) ? 60 : \
        (n) & (1ULL << 59) ? 59 : \
        (n) & (1ULL << 58) ? 58 : \
        (n) & (1ULL << 57) ? 57 : \
        (n) & (1ULL << 56) ? 56 : \
        (n) & (1ULL << 55) ? 55 : \
        (n) & (1ULL << 54) ? 54 : \
        (n) & (1ULL << 53) ? 53 : \
        (n) & (1ULL << 52) ? 52 : \
        (n) & (1ULL << 51) ? 51 : \
        (n) & (1ULL << 50) ? 50 : \
        (n) & (1ULL << 49) ? 49 : \
        (n) & (1ULL << 48) ? 48 : \
        (n) & (1ULL << 47) ? 47 : \
        (n) & (1ULL << 46) ? 46 : \
        (n) & (1ULL << 45) ? 45 : \
        (n) & (1ULL << 44) ? 44 : \
        (n) & (1ULL << 43) ? 43 : \
        (n) & (1ULL << 42) ? 42 : \
        (n) & (1ULL << 41) ? 41 : \
        (n) & (1ULL << 40) ? 40 : \
        (n) & (1ULL << 39) ? 39 : \
        (n) & (1ULL << 38) ? 38 : \
        (n) & (1ULL << 37) ? 37 : \
        (n) & (1ULL << 36) ? 36 : \
        (n) & (1ULL << 35) ? 35 : \
        (n) & (1ULL << 34) ? 34 : \
        (n) & (1ULL << 33) ? 33 : \
        (n) & (1ULL << 32) ? 32 : \
        (n) & (1ULL << 31) ? 31 : \
        (n) & (1ULL << 30) ? 30 : \
        (n) & (1ULL << 29) ? 29 : \
        (n) & (1ULL << 28) ? 28 : \
        (n) & (1ULL << 27) ? 27 : \
        (n) & (1ULL << 26) ? 26 : \
        (n) & (1ULL << 25) ? 25 : \
        (n) & (1ULL << 24) ? 24 : \
        (n) & (1ULL << 23) ? 23 : \
        (n) & (1ULL << 22) ? 22 : \
        (n) & (1ULL << 21) ? 21 : \
        (n) & (1ULL << 20) ? 20 : \
        (n) & (1ULL << 19) ? 19 : \
        (n) & (1ULL << 18) ? 18 : \
        (n) & (1ULL << 17) ? 17 : \
        (n) & (1ULL << 16) ? 16 : \
        (n) & (1ULL << 15) ? 15 : \
        (n) & (1ULL << 14) ? 14 : \
        (n) & (1ULL << 13) ? 13 : \
        (n) & (1ULL << 12) ? 12 : \
        (n) & (1ULL << 11) ? 11 : \
        (n) & (1ULL << 10) ? 10 : \
        (n) & (1ULL << 9) ? 9 : \
        (n) & (1ULL << 8) ? 8 : \
        (n) & (1ULL << 7) ? 7 : \
        (n) & (1ULL << 6) ? 6 : \
        (n) & (1ULL << 5) ? 5 : \
        (n) & (1ULL << 4) ? 4 : \
        (n) & (1ULL << 3) ? 3 : \
        (n) & (1ULL << 2) ? 2 : \
        (n) & (1ULL << 1) ? 1 : \
        (n) & (1ULL << 0) ? 0 : \
        ____ilog2_NaN() \
        ) : \
        (sizeof(n) <= 4) ? \
        __ilog2_u32(n) : \
        __ilog2_u64(n) \
        )

/**
 * roundup_pow_of_two - round the given value up to nearest power of two
 * @n - parameter
 *
 * round the given value up to the nearest power of two
 * - the result is undefined when n == 0
 * - this can be used to initialise global variables from constant data
 */
#define roundup_pow_of_two(n) \
    ( \
        __builtin_constant_p(n) ? ( \
        (n == 1) ? 1 : \
        (1UL << (ilog2((n) - 1) + 1)) \
        ) : \
        __roundup_pow_of_two(n) \
    )

/**
 * rounddown_pow_of_two - round the given value down to nearest power of two
 * @n - parameter
 *
 * round the given value down to the nearest power of two
 * - the result is undefined when n == 0
 * - this can be used to initialise global variables from constant data
 */
#define rounddown_pow_of_two(n)         \
(                       \
    __builtin_constant_p(n) ? (     \
        (n == 1) ? 0 :          \
        (1UL << ilog2(n))) :        \
    __rounddown_pow_of_two(n)       \
)

/**
 * order_base_2 - calculate the (rounded up) base 2 order of the argument
 * @n: parameter
 *
 * The first few values calculated by this routine:
 *  ob2(0) = 0
 *  ob2(1) = 0
 *  ob2(2) = 1
 *  ob2(3) = 2
 *  ob2(4) = 2
 *  ob2(5) = 3
 *  ... and so on.
 */

#define order_base_2(n) ilog2(roundup_pow_of_two(n))

#endif /* _LINUX_LOG2_*/
