"use client";

import { useEffect, useState } from "react";
import { ICart } from "@/interfaces/ICart";
import { fetchCart } from "@/services/api/cart/get";
import { updateCartQuantity } from "@/services/api/cart/put";
import { removeFromCart } from "@/services/api/cart/delete";
import CartList from "@/components/layout/cart/cart-list";

const CartPage = () => {
  const [cart, setCart] = useState<ICart>({ items: [], total: 0 });
  const id_cliente = 3; // Hardcoded for testing; replace with dynamic client ID from auth

  useEffect(() => {
    const loadCart = async () => {
      const data = await fetchCart(id_cliente);
      setCart({
        items: data.items || [],
        total: data.total || 0,
      });
    };
    loadCart();
  }, []);

  const handleUpdateQuantity = async (productId: number, quantity: number) => {
    await updateCartQuantity(id_cliente, productId, quantity);
    const data = await fetchCart(id_cliente);
    setCart({
      items: data.items || [],
      total: data.total || 0,
    });
  };

  const handleRemove = async (productId: number) => {
    await removeFromCart(id_cliente, productId);
    const data = await fetchCart(id_cliente);
    setCart({
      items: data.items || [],
      total: data.total || 0,
    });
  };

  return (
    <section className="w-full py-4">
      <h2 className="text-2xl font-bold mb-4">Carrinho de Compras</h2>
      <CartList
        cart={cart}
        onUpdateQuantity={handleUpdateQuantity}
        onRemove={handleRemove}
      />
      {cart.items.length > 0 && (
        <div className="w-full max-w-screen-xl mx-auto px-4 mt-4">
          <button className="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Finalizar Compra
          </button>
        </div>
      )}
    </section>
  );
};

export default CartPage;
