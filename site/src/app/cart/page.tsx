"use client";

import { useEffect, useState } from "react";
import { ICart } from "@/interfaces/ICart";
import { fetchCart } from "@/services/api/cart/get";
import { updateCartQuantity } from "@/services/api/cart/put";
import { removeFromCart } from "@/services/api/cart/delete";
import CartList from "@/components/layout/cart/cart-list";

const CartPage = () => {
  const [cart, setCart] = useState<ICart>({ items: [], total: 0 });
  const id_cliente = 3;

  useEffect(() => {
    const loadCart = async () => {
      const cartData = await fetchCart(id_cliente);
      setCart(cartData);
    };
    loadCart();
  }, [id_cliente]);

  const handleUpdateQuantity = async (productId: number, delta: number) => {
    try {
      await updateCartQuantity(id_cliente, productId, delta);
      const cartData = await fetchCart(id_cliente);
      setCart(cartData);
    } catch (error) {
      console.error("Erro ao atualizar quantidade:", error);
    }
  };

  const handleRemove = async (productId: number) => {
    try {
      await removeFromCart(id_cliente, productId);
      const cartData = await fetchCart(id_cliente);
      setCart(cartData);
    } catch (error) {
      console.error("Erro ao remover item:", error);
    }
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
